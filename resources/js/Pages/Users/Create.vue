<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 700px;" header-class="p-3 bg-primary-subtle" :title="(!editable) ? 'Create User' : 'Edit User'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <div class="row g-3 mt-0">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" v-model="form.firstname" class="form-control bg-light border-0" placeholder="Please enter first name">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Middle Name</label>
                    <input type="text" v-model="form.middlename" class="form-control bg-light border-0" placeholder="Please enter middle name">
                </div>
                <div class="col-md-6 mt-0">
                    <label class="form-label">Last Name</label>
                    <input type="text" v-model="form.lastname" class="form-control bg-light border-0" placeholder="Please enter last name">
                </div>
                <div class="col-md-6 mt-0">
                    <label class="form-label">Suffix</label>
                    <input type="text" v-model="form.suffix" class="form-control bg-light border-0" placeholder="Please enter suffix">
                </div>
                <div class="col-md-12 mt-0">
                    <hr class="text-muted"/>
                </div>
                <div class="col-md-6 mt-0">
                    <label class="form-label">Email</label>
                    <input type="text" v-model="form.email" class="form-control bg-light border-0" placeholder="Please enter email">
                </div>
                <div class="col-md-6 mt-0">
                    <label class="form-label">Mobile</label>
                    <input type="text" v-model="form.mobile" class="form-control bg-light border-0" placeholder="Please enter mobile">
                </div>
                <div class="col-md-6 mt-0">
                    <label class="form-label">Sex</label>
                    <Multiselect :options="['Male','Female']" label="name" v-model="form.gender" :message="form.errors.gender" placeholder="Select gender" ref="multiselect1"/>
                </div>
                <div class="col-md-6 mt-0">
                    <label class="form-label">Role</label>
                    <Multiselect :options="['Doctor','Midwife','Nurse','Others']" label="name" v-model="form.role" :message="form.errors.role" placeholder="Select role" ref="multiselect1"/>
                </div>
            </div>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Submit</b-button>
        </template>
    </b-modal>
</template>
<script>
import _ from 'lodash';
import { useForm } from '@inertiajs/vue3';
import Multiselect from "@vueform/multiselect";
export default {
    components: { Multiselect },
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                firstname: null,
                middlename: null,
                lastname: null,
                suffix: null,
                email: null,
                mobile: null,
                gender: null,
                role: null
            }),
            showModal: false,
            editable: false
        }
    },
    methods: { 
        show(){
            this.form.reset();
            this.showModal = true;
        },
        edit(data){
            this.editable = true;
            this.form.id = data.id;
            this.form.firstname = data.firstname;
            this.form.middlename = data.middlename;
            this.form.lastname = data.lastname;
            this.form.suffix = data.suffix;
            this.form.email = data.email;
            this.form.mobile = data.mobile;
            this.form.gender = data.gender;
            this.form.role = data.role;
            this.showModal = true;
        },
        submit(){
            if(this.editable){
                this.form.put('/users/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('update',true);
                        this.form.reset();
                        this.hide();
                    }
                });
            }else{
                this.form.post('/users',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('update',true);
                        this.hide();
                    },
                });
            }
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide(){
            this.form.reset();
            this.editable = false;
            this.showModal = false;
        }
    }
}
</script>
<style scoped>
.form-label {
    font-size: 12px;
    margin-bottom: 5px;
}
</style>