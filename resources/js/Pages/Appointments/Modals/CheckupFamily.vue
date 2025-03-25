<template>
    <b-modal v-model="showModal" style="--vz-modal-width: 600px;" header-class="p-3 bg-light" title="Add Checkup" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 mt-n3">
                <div class="col-md-12 mt-2">
                    <label class="form-label">Type <span v-if="form.errors.type_id" class="text-danger" style="font-size: 9px;">({{form.errors.type_id}})</span></label>
                    <Multiselect :options="dropdowns.types" label="name" v-model="form.type_id" object :message="form.errors.type_id" placeholder="Select type" ref="multiselect1"/>
                </div>  
                <div class="col-md-6 mt-2">
                    <label class="form-label">Date <span v-if="form.errors.date_at" class="text-danger" style="font-size: 9px;">({{form.errors.date_at}})</span></label>
                    <input type="date" v-model="form.date_at" class="form-control bg-light border-0" placeholder="Please enter date_at">
                </div>    
                <div class="col-md-6 mt-2">
                    <label class="form-label">Count <span v-if="form.errors.count" class="text-danger" style="font-size: 9px;">({{form.errors.count}})</span></label>
                    <input type="text" v-model="form.count" class="form-control bg-light border-0" readonly>
                </div>           
                <div class="col-md-12 mt-0">
                    <hr class="text-muted mt0 mb-0"/>
                </div>
                <div class="col-md-12 mt-2">
                    <label class="form-label">Remarks </label>
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
                count: null,
                type_id: null,
                date_at: null,
                remarks: null
            }),
            showModal: false
        }
    },
    methods: { 
        show(type,id){
            this.form.reset();
            this.form.id = id;
            this.form.count = type;
            this.showModal = true;
        },
        submit(){
            this.form.post('/checkupf',{
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