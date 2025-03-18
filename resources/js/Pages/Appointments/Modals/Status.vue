<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Mark as Completed" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BCol lg="12" class="mt-4 mb-4">
                <InputLabel for="name" value="Remarks" :message="form.errors.remarks"/>
                <textarea type="date" v-model="form.remarks" class="form-control bg-light border-0" placeholder="Please enter remarks"/>
            </BCol>
            <span class="fw-semibold text-success text-center">Are you sure you want to mark is as completed?</span>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>No</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Yes</b-button>
        </template>
    </b-modal>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Shared/Components/Forms/InputLabel.vue';
export default {
    components: { InputLabel}, 
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                remarks: null
            }),
            showModal: false
        }
    },  
    methods: { 
        show(data){
            this.form.id = data.id;
            this.showModal = true;
        },
        submit(){
            this.form.post('/status',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.$emit('update',true);
                    this.hide();
                },
            });
        },
        hide(){
            this.showModal = false;
        }
    }
}
</script>