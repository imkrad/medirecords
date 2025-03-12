<template>
    <!-- style="--vz-modal-width: 700px -->
    <b-modal v-model="showModal" size="lg" header-class="p-3 bg-primary-subtle" title="Create Appointment" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <div class="row g-3 mt-0 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <Multiselect v-model="form.patient_id" @search-change="fetchPatient" placeholder="Search patient" :searchable="true" :close-on-select="true" label="name" :options="patients" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Service</label>
                    <Multiselect :options="services" label="name" v-model="form.service_id" :message="form.errors.service_id" placeholder="Select service" ref="multiselect1"/>
                </div>
                <div class="col-md-12">
                    <hr class="text-muted mt-0 mb-0"/>
                </div>
                <template v-if="form.service_id">
                    <Family v-if="form.service_id === 9" ref="family"/>
                    <Prenatal v-else-if="form.service_id === 8"  ref="prenatal"/>
                    <Immunization v-else-if="form.service_id === 7" ref="immunization"/>
                    <Consultation v-else  ref="consultation"/>
                </template>
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
import Family from './Forms/Family.vue';
import Prenatal from './Forms/Prenatal.vue';
import Consultation from './Forms/Consultation.vue';
import Immunization from './Forms/Immunization.vue';
import { useForm } from '@inertiajs/vue3';
import Multiselect from "@vueform/multiselect";
export default {
    components: { Multiselect, Family, Prenatal, Consultation, Immunization },
    props: ['services'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                patient_id: null,
                service_id: null
            }),
            patients: [],
            showModal: false,
            editable: false
        }
    },
    methods: { 
        show(){
            this.form.reset();
            this.showModal = true;
        },
        fetchPatient(code){
            axios.get('/search',{
                params: {
                    option: 'patient',
                    code: code
                }
            })
            .then(response => {
                this.patients = response.data;
            })
            .catch(err => console.log(err));
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