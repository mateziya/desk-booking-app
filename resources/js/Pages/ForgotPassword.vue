<script setup>
import Container from '../Components/Container.vue';
import Title from '../Components/Title.vue';
import InputField from '../Components/InputField.vue';
import PrimaryBtn from '../Components/PrimaryBtn.vue';
import ErrorMessages from '../Components/ErrorMessages.vue';
import SessionMessages from '../Components/SessionMessages.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  email: ''
});

defineProps({ status: String });

const submit = () => {
  form.post(route('password.email'));
};
</script>

<template>
  <Container class="mt-20">
    <img class="my-4 h-20 w-auto mx-auto" src="../Images/Icon.png" alt="App Logo">
    <div class="mb-8 text-center">
      <Title class="mt-4">Forgot your password?</Title>
      <p class="mt-3 text-slate-400">
        No problem. Type your email address and we will email you a password reset link!
      </p>
    </div>

    <ErrorMessages :errors="form.errors" />
    <SessionMessages :status="status" />

    <form @submit.prevent="submit" class="space-y-6">
      <InputField label="Email" icon="envelope" v-model="form.email" />

      <PrimaryBtn :disabled="form.processing">Send Password Reset Link</PrimaryBtn>
    </form>
  </Container>
</template>