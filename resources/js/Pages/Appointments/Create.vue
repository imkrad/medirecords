<template>
    <!-- style="--vz-modal-width: 700px -->
    <b-modal v-model="showModal" header-class="p-3 bg-primary-subtle" title="Create Appointment" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <div class="row g-3 mt-0 mb-3">
                <div class="col-md-12 mt-0">
                    <label class="form-label">Service</label>
                    <Multiselect :options="services" label="name" v-model="form.service" :message="form.errors.service" placeholder="Select service" ref="multiselect1"/>
                </div>
            </div>
            <template v-if="form.service">
                <Family v-if="form.service === 9" ref="family"/>
                <Prenatal v-else-if="form.service === 8"  ref="prenatal"/>
                <Immunization v-else-if="form.service === 7" ref="immunization"/>
                <Consultation v-else  ref="consultation"/>
            </template>
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
                service: null
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