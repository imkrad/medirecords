<template>
    <div class="col-md-6">
        <label class="form-label">Type <span v-if="errors.type_id" class="text-danger" style="font-size: 9px;">({{form.errors.type_id}})</span> </label>
        <Multiselect :options="dropdowns.types" label="name" v-model="form.type_id" :message="errors.type_id" placeholder="Select type" ref="multiselect1"/>
    </div>
    <div class="col-md-6">
        <label class="form-label">Method <span v-if="errors.method_id" class="text-danger" style="font-size: 9px;">({{form.errors.method_id}})</span></label>
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