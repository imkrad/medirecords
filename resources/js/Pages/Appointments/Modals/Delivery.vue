<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 900px;" header-class="p-3 bg-light" title="Add Delivery" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 mt-n3">
                <div class="col-md-4">
                    <label class="form-label">First Name <span v-if="form.errors.firstname" class="text-danger" style="font-size: 9px;">({{form.errors.firstname}})</span></label>
                    <input type="text" v-model="form.firstname" class="form-control bg-light border-0" placeholder="Please enter first name">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Middle Name <span v-if="form.errors.middlename" class="text-danger" style="font-size: 9px;">({{form.errors.middlename}})</span></label>
                    <input type="text" v-model="form.middlename" class="form-control bg-light border-0" placeholder="Please enter middle name">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Last Name <span v-if="form.errors.lastname" class="text-danger" style="font-size: 9px;">({{form.errors.lastname}})</span></label>
                    <input type="text" v-model="form.lastname" class="form-control bg-light border-0" placeholder="Please enter last name">
                </div>
                <div class="col-md-4 mt-0">
                    <label class="form-label">Date of Birth <span v-if="form.errors.birthdate" class="text-danger" style="font-size: 9px;">({{form.errors.birthdate}})</span></label>
                    <input type="date" v-model="form.birthdate" class="form-control bg-light border-0" placeholder="Please enter date of birth">
                </div>
                <div class="col-md-4 mt-0">
                    <label class="form-label">Sex <span v-if="form.errors.sex" class="text-danger" style="font-size: 9px;">({{form.errors.sex}})</span></label>
                    <Multiselect :options="['Male','Female']" label="name" v-model="form.sex" :message="form.errors.sex" placeholder="Select Sex" ref="multiselect1"/>
                </div>
                <div class="col-md-4 mt-0">
                    <label class="form-label">Marital Status <span v-if="form.errors.status" class="text-danger" style="font-size: 9px;">({{form.errors.status}})</span></label>
                    <!-- <input type="text" v-model="form.status" class="form-control bg-light border-0" placeholder="Please enter email"> -->
                    <Multiselect :options="['Single','Married','Divorced','Separated','Widowed']" label="name" v-model="form.status" :message="form.errors.status" placeholder="Select Status" ref="multiselect1"/>
                </div>                
                <div class="col-md-12 mt-0">
                    <hr class="text-muted mt0 mb-0"/>
                </div>
                <div class="col-md-4 mt-2">
                    <label class="form-label">Delivery Type <span v-if="form.errors.delivery_id" class="text-danger" style="font-size: 9px;">({{form.errors.delivery_id}})</span></label>
                    <Multiselect :options="dropdowns.deliveries" label="name" v-model="form.delivery_id" :message="form.errors.delivery_id" placeholder="Select type" ref="multiselect1"/>
                </div>
                <div class="col-md-4 mt-2">
                    <label class="form-label">Outcome <span v-if="form.errors.outcome_id" class="text-danger" style="font-size: 9px;">({{form.errors.outcome_id}})</span></label>
                    <Multiselect :options="dropdowns.outcomes" label="name" v-model="form.outcome_id" :message="form.errors.outcome_id" placeholder="Select outcome" ref="multiselect1"/>
                </div>
                <div class="col-md-4 mt-2">
                    <label class="form-label">Birth Weight <span v-if="form.errors.weight_id" class="text-danger" style="font-size: 9px;">({{form.errors.weight_id}})</span></label>
                    <Multiselect :options="dropdowns.weights" label="name" v-model="form.weight_id" :message="form.errors.weight_id" placeholder="Select attendant" ref="multiselect1"/>
                </div>
                <div class="col-md-4 mt-2">
                    <label class="form-label">Facility <span v-if="form.errors.facility_id" class="text-danger" style="font-size: 9px;">({{form.errors.facility_id}})</span></label>
                    <Multiselect :options="dropdowns.facilities" label="name" v-model="form.facility_id" :message="form.errors.facility_id" placeholder="Select facility" ref="multiselect1"/>
                </div>
                <div class="col-md-4 mt-2">
                    <label class="form-label">Attendant Type <span v-if="form.errors.attendant_id" class="text-danger" style="font-size: 9px;">({{form.errors.attendant_id}})</span></label>
                    <Multiselect :options="dropdowns.attendants" label="name" v-model="form.attendant_id" :message="form.errors.attendant_id" placeholder="Select attendant" ref="multiselect1"/>
                </div>
                <div class="col-md-4 mt-2">
                    <label class="form-label">Attendant Name <span v-if="form.errors.attendant_name" class="text-danger" style="font-size: 9px;">({{form.errors.attendant_name}})</span></label>
                    <input type="text" v-model="form.attendant_name" class="form-control bg-light border-0" placeholder="Please enter attendant">
                </div>
                <div class="col-md-12 mt-2">
                    <label class="form-label">Remarks </label>
                    <textarea type="text" v-model="form.remarks" class="form-control bg-light border-0" placeholder="Please enter remarks"/>
                </div>
            </BRow>
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
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
import TextInput from '@/Shared/Components/Forms/TextInput.vue';
export default {
    components: { Multiselect, InputLabel, TextInput },
    props: ['dropdowns'],
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                firstname: null,
                middlename: null,
                lastname: null,
                sex: null,
                birthdate: null,
                status: null,
                attendant: null,
                attendant_id: null,
                weight_id: null,
                facility_id: null,
                outcome_id: null, 
                delivery_id: null,
                attendant_name: null
            }),
            showModal: false
        }
    },
    methods: { 
        show(id){
            this.form.reset();
            this.form.id = id;
            this.showModal = true;
        },
        submit(){
            this.form.post('/delivery',{
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