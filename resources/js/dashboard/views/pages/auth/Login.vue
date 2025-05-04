<template lang="">
    <div id="login" class="login-form-container">
        <header>LOGIN</header>
        <fieldset>
            <form method="POST" @submit.prevent="auth_store.login($event.target)">
                <div class="input-wrapper">
                    <div>
                        <input type="text"
                            name="email"
                            required
                            placeholder="your@email.com" />
                    </div>
                </div>
                <div class="input-wrapper">
                    <div>
                        <input
                            type="password"
                            name="password" required
                            placeholder="password" />
                    </div>
                </div>
                <button id="" type="submit">Login</button>
            </form>
        </fieldset>
    </div>
</template>
<script>
import auth_store from '../../../stores/auth_store';
export default {
    data: ()=>({
        auth_store: auth_store(),
    })
}
</script>
<style lang="">

</style>
