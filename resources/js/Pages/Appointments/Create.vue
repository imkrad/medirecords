<template>
    <!-- style="--vz-modal-width: 700px -->
    <b-modal v-model="showModal" size="lg" header-class="p-3 bg-primary-subtle" title="Create Appointment" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <div class="row g-3 mt-0 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Patient <span v-if="form.errors.patient_id" class="text-danger" style="font-size: 9px;">({{form.errors.patient_id}})</span></label>
                    <Multiselect v-model="form.patient_id" @search-change="fetchPatient" object placeholder="Search patient" :searchable="true" :close-on-select="true" label="name" :options="patients" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Service <span v-if="form.errors.service_id" class="text-danger" style="font-size: 9px;">({{form.errors.service_id}})</span></label>
                    <Multiselect :options="services" label="name" v-model="form.service_id" :message="form.errors.service_id" placeholder="Select service" ref="multiselect1"/>
                </div>
                <BCol lg="12" class="mt-0 mb-n3"><hr class="text-muted"/></BCol>
                <BCol lg="8" style="margin-top: 13px; margin-bottom: -12px;" class="fs-12" :class="form.errors.is_nhts ? 'text-danger' : ''">
                    Please specify: Is it NHTS (Yes) or Non-NHTS (No)?
                </BCol>
                <BCol lg="4" style="margin-top: 13px; margin-bottom: -12px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_nhts')" value="1" v-model="form.is_nhts">
                                <label class="custom-control-label fw-normal fs-12" for="customRadio1">Yes</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="customRadio2" class="custom-control-input me-2" @input="handleInput('is_nhts')" value="0" v-model="form.is_nhts">
                                <label class="custom-control-label fw-normal fs-12" for="customRadio2">No</label>
                            </div>
                        </div>
                    </div>
                </BCol>
                <BCol lg="12" class="mt-n2 mb-n3"><hr class="text-muted"/></BCol>
                <template v-if="form.service_id">
                    <Family :errors="form.errors" :form="form" :dropdowns="families" v-if="form.service_id === 9" ref="family"/>
                    <Prenatal :errors="form.errors" :form="form" v-else-if="form.service_id === 8"  ref="prenatal"/>
                    <Immunization :errors="form.errors" :form="form" :dropdowns="immunizations" v-else-if="form.service_id === 7" ref="immunization"/>
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
    props: ['services','families','immunizations'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                patient_id: null,
                service_id: null,
                is_nhts: null,
                type_id: null,
                method_id: null,
                source: null,
                registration_at: null,
                lmp_at: null,
                edc_at: null,
                weight: null,
                height: null,
                cpab_id: null,
                weight_id: null,
                weight: null,
                length: null,
                was_breastfeed: null

            }),
            patients: [],
            showModal: false,
            editable: false
        }
    },
    watch: {
        'form.service_id'(newVal) {
            if (newVal === 9) {
                this.form.type_id = null;
                this.form.method_id = null;
                this.form.source = null;
                this.form.registration_at = null;
            } else if (newVal === 10) {
               
            } else {
            
            }
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
            this.form.post('/appointments',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.$emit('update',true);
                    this.hide();
                },
            });
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