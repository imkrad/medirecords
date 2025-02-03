<template>
    <Head title="Log in"/>
    <div class="auth-page-wrapper pt-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-page-content">
            <BContainer>

                <BRow class="justify-content-center">
                    <BCol md="8" lg="6" xl="5">
                        <BCard no-body class="mt-4">

                            <BCardBody class="p-4">
                                <div class="row">
                                    <div class="d-flex mb-n3">
                                        <div class="flex-shrink-0 me-4">
                                            <div style="height:2.5rem;width:2.5rem;">
                                                <img src="@assets/images/doh-logo.png" alt="" class="avatar-sm">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 mt-1">
                                            <h5 class="mb-0 fw-semibold fs-16"><span class="text-body">Health Center - Tugbungan</span></h5>
                                            <p class="text-muted text-truncate-two-lines fs-12">DOH | Health Center Information System</p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="text-muted mt-4"/>
                                <div v-if="status" class="alert alert-success text-success">
                                    {{ status }}
                                </div>
                                <div class="p-2 mt-n1">
                                    <form class="customform" @submit.prevent="submit">

                                        <div class="mb-2">
                                            <InputLabel for="email" value="Email" />
                                            <TextInput id="email" v-model="form.email" type="email" class="form-control" placeholder="Please enter email"/>
                                            <InputError :message="form.errors.email" />
                                        </div>

                                        <div class="mb-3">
                                            <InputLabel for="password" value="Password" />
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input :type="togglePassword ? 'text' : 'password'" class="form-control pe-5" placeholder="Enter password" id="password-input" v-model="form.password" autocomplete="password" required :class="{ 'is-invalid': form.errors.password }">
                                                <BButton variant="link" class="position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon" @click="togglePassword = !togglePassword">
                                                    <i class="ri-eye-fill align-middle"></i>
                                                </BButton>
                                                <InputError :message="form.errors.password" />
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <Checkbox v-model:checked="form.remember" name="remember" class="form-check-input" id="auth-remember-check" />
                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>
                                        </div>

                                        <div class="mt-4">
                                            <BButton variant="primary" class="w-100" type="submit" :disabled="form.processing">Sign In</BButton>
                                        </div>

                                        <div class="mt-4 fs-10 text-center">
                                            <p class="mb-0">Forgot your password? 
                                                <Link href="/forgot-password" class="fw-semibold text-primary text-decoration-underline"> Click here</Link>
                                            </p>
                                        </div>

                                    </form>
                                </div>
                            </BCardBody>
                        </BCard>
                    </BCol>
                </BRow>
            </BContainer>
        </div>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import Checkbox from '@/Shared/Components/Forms/Checkbox.vue';
import InputError from '@/Shared/Components/Forms/InputError.vue';
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
defineProps({
    canResetPassword: Boolean,
    status: String
});
const form = useForm({
    email: '',
    password: '',
    remember: false,
});
const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post('/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>
<script>
export default {
    layout: null,
    data() {
        return {
            togglePassword: false
        }
    },
}
</script>
<style>
.auth-page-wrapper {
    background-color: #066b5e;
}
</style>
