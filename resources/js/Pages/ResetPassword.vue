<script setup>
import Container from '../Components/Container.vue';
import Title from '../Components/Title.vue';
import InputField from '../Components/InputField.vue';
import PrimaryBtn from '../Components/PrimaryBtn.vue';
import ErrorMessages from '../Components/ErrorMessages.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  token: String,
  email: String,
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.update"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <Container class="mt-8 max-w-sm sm:max-w-md sm:mt-10 lg:mt-14">
    <img class="my-4 h-20 w-auto mx-auto" src="../Images/Icon.png" alt="App Logo">
    <div class="mb-8 text-center">
      <Title>Enter your new password</Title>
    </div>

    <ErrorMessages :errors="form.errors" />

    <form @submit.prevent="submit" class="space-y-6">
      <InputField label="Email" icon="envelope" v-model="form.email" />
      <InputField label="Password" type="password" icon="lock" v-model="form.password" />
      <InputField label="Confirm Password" type="password" icon="lock" v-model="form.password_confirmation" />

      <PrimaryBtn :disabled="form.processing">Reset Password</PrimaryBtn>
    </form>
  </Container>
</template>