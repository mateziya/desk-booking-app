<script setup>
import Container from '../Components/Container.vue';
import Title from '../Components/Title.vue';
import TextLink from '../Components/TextLink.vue';
import InputField from '../Components/InputField.vue';
import PrimaryBtn from '../Components/PrimaryBtn.vue';
import ErrorMessages from '../Components/ErrorMessages.vue';
import SessionMessages from '../Components/SessionMessages.vue';
import CheckBox from '../Components/CheckBox.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
  remember: null
});

defineProps({ status: String });

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password')
  });
};
</script>

<template>
  <Container class="mt-20 lg:max-w-md md:max-w-md">
    <img class="my-4 h-20 w-auto mx-auto" src="../Images/Icon.png" alt="App Logo">
    <div class="mb-8 text-center">
      <Title class="mt-6">Log in to your account</Title>
    </div>

    <ErrorMessages :errors="form.errors" />
    <SessionMessages :status="status" />

    <form @submit.prevent="submit" class="space-y-6">
      <InputField label="Email" icon="envelope" v-model="form.email" />
      <InputField label="Password" type="password" icon="lock" v-model="form.password" />

      <div class="flex items-center justify-between">
        <CheckBox name="remember" v-model="form.remember">
          Remember me
        </CheckBox>
        <TextLink routeName="password.request" label="Forgot Password?"  />
      </div>

      <PrimaryBtn :disabled="form.processing">Log In</PrimaryBtn>
    </form>
  </Container>
</template>