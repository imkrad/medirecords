<template>
    <div class="col-md-12">
        <label class="form-label">Child protected at birth (CPAB)<span v-if="errors.cpab_id" class="text-danger" style="font-size: 9px;">({{form.errors.cpab_id}})</span> </label>
        <Multiselect :options="dropdowns.cpabs" label="name" v-model="form.cpab_id" :message="errors.cpab_id" placeholder="Select type" ref="multiselect1"/>
    </div>
    <div class="col-md-3">
        <label class="form-label">Length <span v-if="errors.length" class="text-danger" style="font-size: 9px;">({{form.errors.length}})</span></label>
        <input type="text" v-model="form.length" class="form-control bg-light border-0" placeholder="Please enter length">
    </div>
    <div class="col-md-3">
        <label class="form-label">Weight <span v-if="errors.weight" class="text-danger" style="font-size: 9px;">({{form.errors.weight}})</span></label>
        <input type="text" v-model="form.weight" class="form-control bg-light border-0" placeholder="Please enter weight">
    </div>
    <div class="col-md-3">
        <label class="form-label">Status (Birth Weight)<span v-if="errors.weight_id" class="text-danger" style="font-size: 9px;">({{form.errors.weight_id}})</span> </label>
        <Multiselect :options="dropdowns.weights" label="name" v-model="form.weight_id" :message="errors.weight_id" placeholder="Select status" ref="multiselect1"/>
    </div>
    <div class="col-md-3">
        <label class="form-label">Registration Date <span v-if="errors.registration_at" class="text-danger" style="font-size: 9px;">({{form.errors.registration_at}})</span></label>
        <input type="date" v-model="form.registration_at" class="form-control bg-light border-0" placeholder="Please enter last name">
    </div>
    <BCol lg="12" class="mt-0 mb-n3"><hr class="text-muted"/></BCol>
    <BCol lg="8" style="margin-top: 13px; margin-bottom: -12px;" class="fs-12" :class="form.errors.was_breastfeed ? 'text-danger' : ''">
        Initiate breastfeeding immediately after birth lasting for 90 minutes
    </BCol>
    <BCol lg="4" style="margin-top: 13px; margin-bottom: -12px;">
        <div class="row">
            <div class="col-md-6">
                <div class="custom-control custom-radio mb-3">
                    <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('is_nhts')" value="1" v-model="form.was_breastfeed">
                    <label class="custom-control-label fw-normal fs-12" for="customRadio1">Yes</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-control custom-radio mb-3">
                    <input type="radio" id="customRadio2" class="custom-control-input me-2" @input="handleInput('is_nhts')" value="0" v-model="form.was_breastfeed">
                    <label class="custom-control-label fw-normal fs-12" for="customRadio2">No</label>
                </div>
            </div>
        </div>
    </BCol>
    <BCol lg="12" class="mt-n2 mb-n3"><hr class="text-muted"/></BCol>
</template>
<script>
import Multiselect from "@vueform/multiselect";
export default {
    components: { Multiselect },
    props: ['form','dropdowns','errors'],
    mounted() {
        if (!this.form.registration_at) {
        const today = new Date().toISOString().split('T')[0];
        this.form.registration_at = today;
        }
    }
}
</script>