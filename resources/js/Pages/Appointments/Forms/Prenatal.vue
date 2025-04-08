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
        <label class="form-label">Height (cm)<span v-if="errors.height" class="text-danger" style="font-size: 9px;">({{form.errors.height}})</span></label>
        <input type="text" v-model="form.height" class="form-control bg-light border-0" placeholder="Please enter height">
    </div>
    <div class="col-md-3 mt-2">
        <label class="form-label">Weight (kg)<span v-if="errors.weight" class="text-danger" style="font-size: 9px;">({{form.errors.weight}})</span></label>
        <input type="text" v-model="form.weight" class="form-control bg-light border-0" placeholder="Please enter weight">
    </div>
    <div class="col-md-3 mt-2">
        <label class="form-label">Registration Date <span v-if="errors.registration_at" class="text-danger" style="font-size: 9px;">({{form.errors.registration_at}})</span></label>
        <input type="date" v-model="form.registration_at" class="form-control bg-light border-0" placeholder="Please enter last name">
    </div>
    <div class="col-md-3 mt-2">
        <label class="form-label">Menstrual Cycle <span v-if="form.errors.menstrual_cycle" class="text-danger" style="font-size: 9px;">({{form.errors.menstrual_cycle}})</span></label>
        <Multiselect :options="['Regular','Irregular']" label="name" v-model="form.menstrual_cycle" :message="form.errors.menstrual_cycle" placeholder="select" ref="multiselect1"/>
    </div>
    <div class="col-md-12">
        <hr class="text-muted mt-n2"/>
        <!-- <span class="fw-semibold">Previous Pregnancy Information</span>
        <hr class="text-muted mt-3"/> -->
    </div>
    <div class="col-md-6 mt-0">
        <label class="form-label">No. of previous pregnancy<span v-if="errors.weight" class="text-danger" style="font-size: 9px;">({{form.errors.weight}})</span></label>
        <input type="number" v-model="form.additional_info2.previous_pregnancy" class="form-control bg-light border-0" placeholder="Please enter count">
    </div>
    <div class="col-md-3 mt-0">
        <label class="form-label">Fullterm<span v-if="errors.fullterm" class="text-danger" style="font-size: 9px;">({{form.errors.fullterm}})</span></label>
        <input type="number" v-model="form.additional_info2.fullterm" class="form-control bg-light border-0" placeholder="Please enter count">
    </div>
    <div class="col-md-3 mt-0">
        <label class="form-label">Preterm<span v-if="errors.preterm" class="text-danger" style="font-size: 9px;">({{form.errors.preterm}})</span></label>
        <input type="number" v-model="form.additional_info2.preterm" class="form-control bg-light border-0" placeholder="Please enter count">
    </div>
    <div class="col-md-3 mt-2">
        <label class="form-label">G (Previous + Current)<span v-if="errors.g" class="text-danger" style="font-size: 9px;">({{form.errors.g}})</span></label>
        <input type="number" v-model="form.additional_info2.g" class="form-control bg-light border-0" placeholder="Please enter count">
    </div>
    <div class="col-md-3 mt-2">
        <label class="form-label">P (20 weeks above)<span v-if="errors.p" class="text-danger" style="font-size: 9px;">({{form.errors.p}})</span></label>
        <input type="number" v-model="form.additional_info2.p" class="form-control bg-light border-0" placeholder="Please enter count">
    </div>
    <div class="col-md-3 mt-2">
        <label class="form-label">A (Abortion)<span v-if="errors.a" class="text-danger" style="font-size: 9px;">({{form.errors.a}})</span></label>
        <input type="number" v-model="form.additional_info2.a" class="form-control bg-light border-0" placeholder="Please enter count">
    </div>
    <div class="col-md-3 mt-2">
        <label class="form-label">L (Living Child)<span v-if="errors.l" class="text-danger" style="font-size: 9px;">({{form.errors.l}})</span></label>
        <input type="number" v-model="form.additional_info2.l" class="form-control bg-light border-0" placeholder="Please enter count">
    </div>
    <BCol lg="12" class="mt-0 mb-n3"><hr class="text-muted"/></BCol>
    <BCol lg="8" style="margin-top: 13px; margin-bottom: -12px;" class="fs-12" :class="form.errors.with_medication ? 'text-danger' : ''">
        Any medication?
    </BCol>
    <BCol lg="4" style="margin-top: 13px; margin-bottom: -12px;">
        <div class="row">
            <div class="col-md-6">
                <div class="custom-control custom-radio mb-3">
                    <input type="radio" id="customRadio1" class="custom-control-input me-2" @input="handleInput('with_medication')" value="1" v-model="form.with_medication">
                    <label class="custom-control-label fw-normal fs-12" for="customRadio1">Yes</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-control custom-radio mb-3">
                    <input type="radio" id="customRadio2" class="custom-control-input me-2" @input="handleInput('with_medication')" value="0" v-model="form.with_medication">
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
}
</script>
<style scoped>
.form-label {
    font-size: 12px;
    margin-bottom: 5px;
}
</style>