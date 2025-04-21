<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 500px;" header-class="p-3 bg-light" title="Confirm Immunization" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 mt-n3">
                <div class="col-md-12 mt-2">
                    <label class="form-label">Date <span v-if="form.errors.date_at" class="text-danger" style="font-size: 9px;">({{form.errors.date_at}})</span></label>
                    <input type="date" v-model="form.date_at" class="form-control bg-light border-0" placeholder="Please enter date_at">
                </div>     
                <div class="col-md-12 mt-2">
                    <label class="form-label">Remarks <span v-if="form.errors.remarks" class="text-danger" style="font-size: 9px;">({{form.errors.remarks}})</span></label>
                    <textarea type="text" rows="3" v-model="form.remarks" class="form-control bg-light border-0" placeholder="Please enter remarks"/>
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
                date_at: null,
                remarks: null
            }),
            showModal: false
        }
    },
    methods: { 
        show(selected){
            this.form.reset();
            this.form.id = selected.id;
            this.form.date_at = selected.date_at;
            this.showModal = true;
        },
        submit(){
            this.form.post('/immunization',{
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