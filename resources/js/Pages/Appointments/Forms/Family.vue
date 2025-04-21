<template>
    <div class="col-md-6">
        <label class="form-label">Type <span v-if="errors.type_id" class="text-danger" style="font-size: 9px;">({{form.errors.type_id}})</span> </label>
        <Multiselect :options="dropdowns.types" label="name" v-model="form.type_id" :message="errors.type_id" placeholder="Select type" ref="multiselect1"/>
    </div>
    <div class="col-md-6">
        <label class="form-label">Previous Method <span v-if="errors.method_id" class="text-danger" style="font-size: 9px;">({{form.errors.method_id}})</span></label>
        <Multiselect :options="dropdowns.methods" label="name" v-model="form.method_id" :message="errors.method_id" placeholder="Select method" ref="multiselect1"/>
    </div>
    <div class="col-md-6 mt-2">
        <label class="form-label">Source</label>
        <Multiselect :options="['Public','Private']" label="name" v-model="form.source" :message="errors.source" placeholder="Select source" ref="multiselect1"/>
    </div>
    <div class="col-md-6 mt-2">
        <label class="form-label">Registration Date <span v-if="errors.registration_at" class="text-danger" style="font-size: 9px;">({{form.errors.registration_at}})</span></label>
        <input type="date" v-model="form.registration_at" class="form-control bg-light border-0" placeholder="Please enter last name">
    </div>
    <div class="col-md-12">
        <hr class="text-muted mt-n2 mb-n3"/>
    </div>
    <div class="col-md-4 mt-2">
        <label class="form-label">Blood Pressure <span v-if="errors.registration_at" class="text-danger" style="font-size: 9px;">({{form.errors.bp}})</span></label>
        <input type="text" v-model="form.additional_info.bp" class="form-control bg-light border-0" placeholder="Please enter last name">
    </div>
    <div class="col-md-4 mt-2">
        <label class="form-label">Pulse Rate <span v-if="errors.registration_at" class="text-danger" style="font-size: 9px;">({{form.errors.pulse_rate}})</span></label>
        <input type="text" v-model="form.additional_info.pulse_rate" class="form-control bg-light border-0" placeholder="Please enter last name">
    </div>
    <div class="col-md-4 mt-2">
        <label class="form-label">Temperature <span v-if="errors.registration_at" class="text-danger" style="font-size: 9px;">({{form.errors.temperature}})</span></label>
        <input type="text" v-model="form.additional_info.temperature" class="form-control bg-light border-0" placeholder="Please enter last name">
    </div>
    <div class="col-md-12 mt-0">
            <label class="form-label">Medical History</label>
            <Multiselect 
        :options="['Heart disease', 'Blood clots', 'Liver disease', 'Migraines', 'Cancer', 'History of smoking']" 
        v-model="form.additional_info.medical_history" 
        placeholder="Select medical history" 
        ref="multiselect1"
        :multiple="true"
        :close-on-select="false"
        :clear-on-select="false"
        track-by="name"
        label="name"
    />
    </div>
    <div class="col-md-12 mt-2">
        <label class="form-label">Remarks (Any allergies or medications?) <span v-if="form.errors.remarks" class="text-danger" style="font-size: 9px;">({{form.errors.remarks}})</span></label>
        <textarea type="text" rows="3" v-model="form.remarks" class="form-control bg-light border-0" placeholder="Please enter any allergies or medications taken"/>
    </div>
</template>
<script>
import Multiselect from "@vueform/multiselect";
export default {
    components: { Multiselect },
    props: ['form','dropdowns','errors'],
    watch: {
        'form.type_id'(newVal) {
            if(newVal == 12){
                this.form.method_id = 32;
            }else{
                this.form.method_id = null;
            }
        }
    },
    mounted() {
        if (!this.form.registration_at) {
        const today = new Date().toISOString().split('T')[0];
        this.form.registration_at = today;
        }
    },
    data(){
        return {
            wew : []
        }
    },
    methods: {

    }
}
</script>
<style scoped>
.form-label {
    font-size: 12px;
    margin-bottom: 5px;
}
</style>