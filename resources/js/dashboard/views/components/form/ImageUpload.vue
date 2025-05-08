<template>
    <div>
        <label class="font-weight-500 text-[14px]">
            {{ label }}
        </label>
        <div class="mt-1">
            <file-pond :name="`file`" ref="pond" :allowMultiple="allowMultiple"
                :server="serverConfig" maxFiles="5" checkValidity="true" @updatefiles="handleFileUpdate"
                @processfiles="handleProcessFiles" @removefile="handleFileRemove" :acceptedFileTypes="['image/*']" />

            <input type="hidden" :name="name" :value="file_urls">
        </div>
    </div>
</template>
<script>
import vueFilePond from 'vue-filepond';
import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

const acceptedFileTypes = 'image/*';
FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);
const FilePondComponent = vueFilePond(FilePondPluginImagePreview);

export default {
    props: {
        label: {
            type: String,
            default: 'Upload Image',
        },
        allowMultiple: {
            type: Boolean,
            default: false,
        },
        callback: {
            type: Function,
            default: () => { },
        },
        name: {
            type: String,
            default: 'photo',
        },
        height: {
            type: String,
            default: '200',
        },
        width: {
            type: String,
            default: '200',
        },
        default_files: {
            type: Array,
            default: [],
        }
    },
    name: 'ImageUploader',
    components: {
        FilePond: FilePondComponent
    },
    data() {
        return {
            files: [],
            file_urls: [],
            acceptedFileTypes,
            acceptedTypes: 'image/*',
        };
    },
    created: function () {
        this.file_urls = this.default_files;
    },
    methods: {
        set_file_urls: function () {
            if (this.allowMultiple) {
                this.file_urls = this.files.map(file => file.serverId);
            } else {
                this.file_urls = this.files[0].serverId;
            }
        },
        handleFileRemove: function () {
            this.callback(this.files);
            this.set_file_urls();
        },
        handleProcessFiles: function () {
            this.callback(this.files);
            this.set_file_urls();
        },
        handleFileUpdate(files) {
            this.files = files;
        },
        createAxiosUploadProcessor() {
            return (fieldName, file, metadata, load, error, progress, abort) => {

                // const is_default_image = this.default_files.find(i=>i.includes('/'+file.name));
                // if (is_default_image) {
                //     return load(is_default_image);
                // }

                if (file.size > 1000000) {
                    error('File size is too big. Should be less than 1MB.');
                    window.s_alert('upload less than 1MB.', 'error');
                    return abort();
                }

                const formData = new FormData()
                formData.append(fieldName, file);
                formData.append('height', this.height);
                formData.append('width', this.width);

                const source = axios.CancelToken.source()

                axios.post(location.origin + '/api/v1/media/upload', formData, {
                    cancelToken: source.token,
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: (e) => {
                        // FilePond expects progress in [0, 1]
                        progress(true, e.loaded, e.total)
                    }
                })
                    .then(async (response) => {
                        // `load` must be called with a unique server ID (like file path, ID, etc.)
                        await load(response.data.data);
                    })
                    .catch((err) => {
                        console.error(err)
                        error('Upload failed')
                    })

                return {
                    abort: () => {
                        source.cancel('Upload aborted by user')
                        abort()
                    }
                }
            }
        },
        revert: function () {
            return (serverId, load, error) => {
                // Use Axios to call your Laravel delete endpoint
                axios.delete(location.origin + '/api/v1/media/delete', {
                    headers: {},
                    data: { path: serverId } // or ID depending on how you track files
                })
                    .then(() => load())
                    .catch(err => {
                        console.error(err)
                        error('Delete failed')
                    })
            }
        }
    },
    computed: {
        serverConfig() {
            return {
                process: this.createAxiosUploadProcessor(),
                revert: this.revert(),
            }
        }
    }
}
</script>

<style>
.filepond--root .filepond--drop-label {
    background: white;
    font-size: 12px;
    min-height: 30px !important;
    border: 1px solid #8080804a;
    border-radius: 2px;
}

.filepond--root .filepond--credits[style] {
    display: none;
}

.filepond--list.filepond--list {
    margin-top: 5px;
}
</style>
