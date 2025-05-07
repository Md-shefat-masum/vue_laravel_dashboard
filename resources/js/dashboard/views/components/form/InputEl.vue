<template>
    <div>
        <label :for="uninque_id_for_label()" class="font-weight-500 text-[14px]">
            {{ label }}

            <b v-if="required" class="text-[#FF5722]">*</b>

            <sub v-if="type == 'file'">
                {{ file_dimension }}
            </sub>

            <sub v-if="type == 'password'">
                <i class="fa fa-eye text-gray-400" @click="input_type=='text'?input_type='password':input_type='text'"></i>
            </sub>

        </label>
        <div class="mt-1">
            <input
                :type="input_type"
                :accept="is_preview && accept"
                :id="uninque_id_for_label()"
                :name="name"
                :required="required"
                :class="`${extra_class} ${!input_not_text?'form-control':'form-check-input'}`"
                :multiple="multiple"
                :value="type != 'file' ? default_value : null"
                :checked="checked"
                @change="input_change_handler"
                ref="input_el"
                :placeholder="placeholder"

                class="
                    w-full
                    text-sm
                    font-weight-300
                    px-[11px] py-[4px] border border-gray-300
                    rounded-e-xs focus:outline-none focus:ring-1
                    focus:ring-gray-500 focus:border-gray-200 shadow-xs
                    placeholder-gray-400"
                />
        </div>
        <div>
            <div class="file_preview" ref="preview_el" v-if="is_preview">
                <!-- <img
                    v-for="(url, index) in image_urls"
                    :key="index"
                    :src="url"
                    :alt="index"
                    ref="preview_el"
                /> -->
                <img v-if="value" :src="value" class="w-[100px] m-1" />
            </div>

        </div>
    </div>
</template>
<script>
export default {
    props: {
        type: {
            type: String,
            default: "text",
        },
        label: {
            type: String,
            default: '',
        },
        placeholder: {
            type: String,
            default: '',
        },
        name: {
            type: String,
            default: null,
            required: false,
        },
        mutator: {
            type: Function,
            default: null,
        },
        checked: {
            type: Boolean,
            default: false,
        },
        accept: {
            type: String,
            default: "image/*",
        },
        value: {
            type: [String, Number],
            default: null,
        },
        required: {
            type: Boolean,
            default: false,
        },
        preview: {
            type: Boolean,
            default: true,
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        extra_class: {
            type: String,
            default: '',
        },
        data_attr: {
            type: Array,
            default: null,
        },
        file_dimension: {
            type: String,
            default: '(200x200)',
        }
    },
    data: function () {
        return {
            image_urls: [],
            input_type: 'text',
            default_value: '',
        };
    },
    methods: {
        input_change_handler: function () {
            if (this.is_preview && this.type == 'file') {
                this.preview_image();
            }

            this.mutator &&
            this.mutator({
                value: event.target.value,
                name: event.target.name,
                event,
            });

            this.default_value = event.target.value;
        },
        preview_image: function () {
            let files = event.target.files;
            let that = this;
            that.$refs.preview_el.innerHTML = ``;

            function dataURItoBlob(dataURI) {
                let byteString = atob(dataURI.split(',')[1]);
                let mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

                let ab = new ArrayBuffer(byteString.length);
                let ia = new Uint8Array(ab);

                for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
                }

                return new Blob([ab], { type: mimeString });
            }

            for (let i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(event){
                    let img = new Image();
                    img.src = event.target.result;
                    let context_data_to_string = dataURItoBlob(img.src);
                    that.$refs.preview_el.innerHTML += `<img class="w-[100px] m-1" src="${URL.createObjectURL(context_data_to_string)}" />`
                };
                reader.readAsDataURL(event.target.files[i]);
            }
        },
        uninque_id_for_label: function(){
            let id = this.name || (this.data_attr?.name && 'data-'.data_attr?.name);
            return this.input_not_text?this.label.replaceAll(' ','_'):id
        },


    },
    created: function(){
        this.input_type = this.type;
        this.default_value = this.value;

        this.$watch('value', function(){
            this.default_value = this.value
        });

    },
    mounted: function(){
        this.data_attr?.map(i=>{
            this.$refs.input_el.dataset[Object.keys(i)[0]] = i[Object.keys(i)[0]];
        })
    },
    computed: {
        is_preview: function () {
            return this.type === "file" && this.preview === true;
        },
        input_not_text: function(){
            return ['checkbox','radio'].includes(this.type);
        }
    },
};

</script>
