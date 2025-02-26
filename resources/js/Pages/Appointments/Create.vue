<template>
    <!-- style="--vz-modal-width: 700px -->
    <b-modal v-model="showModal" header-class="p-3 bg-primary-subtle" title="Create Appointment" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <div class="row g-3 mt-0 mb-3">
                <div class="col-md-12 mt-0">
                    <label class="form-label">Service</label>
                    <Multiselect :options="services" label="name" v-model="form.role" :message="form.errors.role" placeholder="Select role" ref="multiselect1"/>
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
    props: ['services'],
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