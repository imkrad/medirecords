<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Schedule Visit" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow class="g-3 mt-2">
                <BCol lg="12" class="mt-2">
                    <InputLabel for="name" value="Schedule Date" :message="form.errors.scheduled_at"/>
                    <input type="date" v-model="form.scheduled_at" class="form-control bg-light border-0" placeholder="Please enter scheduled_at" @input="handleInput('scheduled_at')">
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
                af_id: null,
                scheduled_at: null
            }),
            showModal: false
        }
    },
    methods: { 
        show(id){
            this.form.reset();
            this.form.af_id = id;
            this.showModal = true;
        },
        submit(){
            this.form.post('/schedule',{
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