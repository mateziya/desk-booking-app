<script setup>
import Container from '../Components/Container.vue';
import Title from '../Components/Title.vue';
import TextLink from '../Components/TextLink.vue';
import InputField from '../Components/InputField.vue';
import PrimaryBtn from '../Components/PrimaryBtn.vue';
import ErrorMessages from '../Components/ErrorMessages.vue';
import CheckBox from '../Components/CheckBox.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: null
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password')
    });
};
</script>

<template>
  <Container class="mt-20">
    <img class="my-4 h-20 w-auto mx-auto" src="../Images/Icon.png" alt="App Logo">
    <div class="mb-8 text-center">
      <Title>Log in to your account</Title>
    </div>

    <ErrorMessages :errors="form.errors" />

    <form @submit.prevent="submit" class="space-y-6">
      <InputField label="Email" icon="at" v-model="form.email" />
      <InputField label="Password" type="password" icon="key" v-model="form.password" />

      <div class="flex items-center justify-between">
        <CheckBox name="remember" v-model="form.remember">
          Remember me
        </CheckBox>
        <TextLink routeName="home" label="Forgot Password?"  />
      </div>

      <PrimaryBtn :disabled="form.processing">Log in</PrimaryBtn>
    </form>
  </Container>
</template>