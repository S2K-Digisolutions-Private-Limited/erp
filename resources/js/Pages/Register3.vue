<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { usePage, Head } from '@inertiajs/vue3'
const form = useForm({
    otp: '',
})
const url2 = route('register.3'); // Use optional chaining to handle possible null or undefined
let submit = () => {
    const url = route('register.verify'); // Use optional chaining to handle possible null or undefined
    if (url) {
        form.post(url);
    }
}
</script>
<template>

    <Head>
        <title>Verify Email</title>
    </Head>
    <div class="d-flex justify-center h-auto my-15 align-center">
        <v-form @submit.prevent="submit">
            <v-card class="py-12 px-8 text-center mx-auto ma-4" max-width="420" width="100%">

                <v-alert v-if="errors.otp" :text="errors.otp" type="error"></v-alert>


                <h3 class="text-h6 mb-2 mt-5">
                    Please enter the one time password to verify your account
                </h3>

                <div>A code has been sent to {{ usePage().props.email }}</div>

                <v-otp-input v-model="form.otp" :error-messages="errors.otp" :loading="loading" length="5"
                    variant="underlined"></v-otp-input>
                <v-btn class="my-5" color="surface-variant" text="Verify" variant="tonal" type="submit"></v-btn>
                <Link class="ms-2" method="get" :href="url2" :data="{ resend: 1 }" as="button" type="button">
                Resend Mail
                </Link>
            </v-card>
        </v-form>
    </div>
</template>
<script>
export default {
    data: () => ({
        loading: false,
    }),
    props: { errors: Object }
}
</script>
