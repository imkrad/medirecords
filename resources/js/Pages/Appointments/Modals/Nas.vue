<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 500px;" header-class="p-3 bg-light" title="Add Nsas" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 mt-n3">
                <div class="col-md-12 mt-1">
                    <label class="form-label">Range <span v-if="form.errors.range_id" class="text-danger" style="font-size: 9px;">({{form.errors.range_id}})</span></label>
                    <Multiselect :options="dropdowns.ranges" label="name" v-model="form.range_id" object :message="form.errors.range_id" placeholder="Select Range" ref="multiselect1"/>
                </div>  
                <div class="col-md-12 mt-1">
                    <label class="form-label">Status <span v-if="form.errors.status_id" class="text-danger" style="font-size: 9px;">({{form.errors.status_id}})</span></label>
                    <Multiselect :options="dropdowns.statuses" label="name" v-model="form.status_id" :message="form.errors.status_id" placeholder="Select Status" ref="multiselect1"/>
                </div>  
                <div class="col-md-6">
                    <label class="form-label">Length <span v-if="form.errors.length" class="text-danger" style="font-size: 9px;">({{form.errors.length}})</span></label>
                    <input type="text" v-model="form.length" class="form-control bg-light border-0" placeholder="Please enter length">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Weight <span v-if="form.errors.weight" class="text-danger" style="font-size: 9px;">({{form.errors.weight}})</span></label>
                    <input type="text" v-model="form.weight" class="form-control bg-light border-0" placeholder="Please enter weight">
                </div>
                <div class="col-md-6 mt-0">
                    <label class="form-label">Age <span v-if="form.errors.age" class="text-danger" style="font-size: 9px;">({{form.errors.age}})</span></label>
                    <input type="text" v-model="form.age" class="form-control bg-light border-0" placeholder="Please enter age">
                </div>
                <div class="col-md-6 mt-0">
                    <label class="form-label">Date <span v-if="form.errors.age" class="text-danger" style="font-size: 9px;">({{form.errors.date}})</span></label>
                    <input type="date" v-model="form.date_at" class="form-control bg-light border-0" placeholder="Please enter date">
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
                length: null,
                weight: null,
                age: null,
                status_id: null,
                date_at: new Date().toISOString().split('T')[0],
                range_id: null
            
            }),
            selected: null,
            showModal: false
        }
    },
    watch: {
        selected(newVal) {
            if (newVal && newVal.patient && newVal.patient.member && newVal.patient.member.birthdate) {
                const today = new Date();
                const birthDate = new Date(newVal.patient.member.birthdate);
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();

                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                this.form.age = age;
            }
        }
    },
    methods: { 
        show(id,appointment){
            this.form.reset();
            this.form.id = id;
            this.selected = appointment;
            this.showModal = true;
        },
        submit(){
            this.form.post('/nsas',{
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