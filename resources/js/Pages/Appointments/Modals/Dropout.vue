<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Dropout Family Planning" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 mt-2">
                <BCol lg="12" class="mt-0">
                    <label class="form-label">Reason <span v-if="form.errors.reason_id" class="text-danger" style="font-size: 9px;">({{form.errors.reason_id}})</span></label>
                    <Multiselect :options="dropdowns.reasons" label="name" v-model="form.reason_id" :message="form.errors.reason_id" placeholder="Select reason" ref="multiselect1"/>
                </BCol>
                <BCol lg="12" class="mt-2">
                    <InputLabel for="name" value="Dropout Date" :message="form.errors.dropout_at"/>
                    <TextInput type="date" v-model="form.dropout_at" class="form-control" placeholder="Please dropout date" @input="handleInput('dropout_at')" :light="true"/>
                </BCol>
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
                dropout_at: null,
                is_dropout: 1,
                reason_id: null,
                option: 'dropout'
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
            this.form.post('/dropout',{
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