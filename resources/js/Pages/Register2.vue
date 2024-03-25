<script setup>
import { router, useForm } from '@inertiajs/vue3'
import { usePage, Head } from '@inertiajs/vue3'

const form = useForm({
    id: usePage().props.school_id,
    step: 2,
    school_name: null,
    address: null,
    city: null, // Define these properties
    pin_code: null,
    mobile_number: null,
    whatsapp_number: null

})

let submit = () => {
    const url = route('register'); // Use optional chaining to handle possible null or undefined
    if (url) {
        form.post(url);
    }
}
</script>
<template>

    <Head>
        <title>Basic Details</title>
    </Head>
    <div style="min-height: 100vh;" class="d-flex justify-center align-center ">
        <v-form class="w-100" @submit.prevent="submit">
            <v-card class="mx-auto w-100 h-100 pa-5 pb-2" elevation="8" max-width="900" rounded="lg">
                <div class="text-center text-h4 mb-5 text-medium-emphasis">Basic Details</div>

                <v-row>
                    <!-- School Name -->
                    <v-col cols="12">
                        <div class="text-subtitle-1 text-medium-emphasis">School Name</div>
                        <v-text-field density="compact" placeholder="School Name" prepend-inner-icon="mdi-school"
                            :error-messages="errors.school_name" v-model="form.school_name"
                            variant="outlined"></v-text-field>
                    </v-col>

                    <!-- Address -->
                    <v-col cols="12">
                        <div class="text-subtitle-1 text-medium-emphasis">Address</div>
                        <v-textarea density="compact" variant="outlined" prepend-inner-icon="mdi-map" rows="2" auto-grow
                            :error-messages="errors.address" v-model="form.address"
                            placeholder="Full Address"></v-textarea>
                    </v-col>

                    <!-- City -->
                    <v-col cols="12" sm="6">
                        <div class="text-subtitle-1 text-medium-emphasis">City</div>
                        <v-text-field density="compact" placeholder="City" prepend-inner-icon="mdi-city"
                            :error-messages="errors.city" v-model="form.city" variant="outlined"></v-text-field>
                    </v-col>

                    <!-- Pin Code -->
                    <v-col cols="12" sm="6">
                        <div class="text-subtitle-1 text-medium-emphasis">Pin Code</div>
                        <v-text-field density="compact" placeholder="Pin Code" prepend-inner-icon="mdi-pin"
                            :error-messages="errors.pin_code" v-model="form.pin_code" variant="outlined"></v-text-field>
                    </v-col>

                    <!-- School Mobile Number -->
                    <v-col cols="12" sm="6">
                        <div class="text-subtitle-1 text-medium-emphasis">School Mobile Number</div>
                        <v-text-field density="compact" placeholder="School Mobile Number" v-model="form.mobile_number"
                            :error-messages="errors.mobile_number" prepend-inner-icon="mdi-phone"
                            variant="outlined"></v-text-field>
                    </v-col>

                    <!-- School WhatsApp Number -->
                    <v-col cols="12" sm="6">
                        <div class="text-subtitle-1 text-medium-emphasis">School WhatsApp Number</div>
                        <v-text-field density="compact" placeholder="School WhatsApp Number"
                            v-model="form.whatsapp_number" prepend-inner-icon="mdi-whatsapp"
                            :error-messages="errors.whatsapp_number" variant="outlined"></v-text-field>
                    </v-col>
                </v-row>

                <v-btn class="mb-8 mt-6" color="blue" size="large" variant="tonal" type="submit" block>
                    Next
                </v-btn>
            </v-card>
        </v-form>
    </div>
</template>
<script>
import { Link } from "@inertiajs/vue3"
export default {
    data: () => ({
        // visible: false,
    }),
    props: { errors: Object },
    components: { Link }
}
</script>
