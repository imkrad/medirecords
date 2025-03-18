<template>
    <div class="col-md-6">
        <label class="form-label">Last Menstrual Period <span v-if="errors.lmp_at" class="text-danger" style="font-size: 9px;">({{form.errors.lmp_at}})</span></label>
        <input type="date" v-model="form.lmp_at" class="form-control bg-light border-0" placeholder="Please enter last name">
    </div>
    <div class="col-md-6">
        <label class="form-label">Esitimated Date of Confinement <span v-if="errors.edc_at" class="text-danger" style="font-size: 9px;">({{form.errors.edc_at}})</span></label>
        <input type="date" v-model="form.edc_at" class="form-control bg-light border-0" placeholder="Please enter last name">
    </div>
    <div class="col-md-3 mt-2">
        <label class="form-label">Height (m)<span v-if="errors.height" class="text-danger" style="font-size: 9px;">({{form.errors.height}})</span></label>
        <input type="text" v-model="form.height" class="form-control bg-light border-0" placeholder="Please enter height">
    </div>
    <div class="col-md-3 mt-2">
        <label class="form-label">Weight (kg)<span v-if="errors.weight" class="text-danger" style="font-size: 9px;">({{form.errors.weight}})</span></label>
        <input type="text" v-model="form.weight" class="form-control bg-light border-0" placeholder="Please enter weight">
    </div>
    <div class="col-md-6 mt-2">
        <label class="form-label">Registration Date <span v-if="errors.registration_at" class="text-danger" style="font-size: 9px;">({{form.errors.registration_at}})</span></label>
        <input type="date" v-model="form.registration_at" class="form-control bg-light border-0" placeholder="Please enter last name">
    </div>
</template>
<script>
export default {
    props: ['form','dropdowns','errors'],
}
</script>
<style scoped>
.form-label {
    font-size: 12px;
    margin-bottom: 5px;
}
</style>