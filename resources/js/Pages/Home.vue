<script setup>
import Container from '../Components/Container.vue';
</script>

<template>
  <div class="py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:text-center">
        <h2 class="text-base/7 font-semibold text-indigo-400">
          Lorem ipsum
        </h2>
        <h1 class="text-balance text-5xl font-semibold tracking-tight text-white sm:text-7xl">Lorem ipsum dolor sit amet.</h1>
        <p class="mt-8 text-pretty text-lg font-medium text-gray-400 sm:text-xl/8">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat.</p>
      </div>
      <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
          <Container class="flex flex-col">
            <dt class="flex items-center gap-x-3 text-base/7 font-semibold text-white">
              <i class="fa-solid fa-bomb fa-lg flex-none text-indigo-400" aria-hidden="true"></i>
              Lorem ipsum
            </dt>
            <dd class="mt-4 flex flex-auto flex-col text-base/7 text-gray-300">
              <p class="flex-auto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor ut praesentium facere at sint nostrum, aliquid dolores ipsam beatae, illo quaerat perspiciatis deserunt ducimus explicabo sapiente, blanditiis iste omnis cumque.</p>
            </dd>
          </Container>
          <Container class="flex flex-col">
            <dt class="flex items-center gap-x-3 text-base/7 font-semibold text-white">
              <i class="fa-solid fa-cloud fa-lg flex-none text-indigo-400" aria-hidden="true"></i>
              Lorem ipsum
            </dt>
            <dd class="mt-4 flex flex-auto flex-col text-base/7 text-gray-300">
              <p class="flex-auto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor ut praesentium facere at sint nostrum, aliquid dolores ipsam beatae, illo quaerat perspiciatis deserunt ducimus explicabo sapiente, blanditiis iste omnis cumque.</p>
            </dd>
          </Container>
          <Container class="flex flex-col">
            <dt class="flex items-center gap-x-3 text-base/7 font-semibold text-white">
              <i class="fa-solid fa-business-time fa-lg flex-none text-indigo-400" aria-hidden="true"></i>
              Lorem ipsum
            </dt>
            <dd class="mt-4 flex flex-auto flex-col text-base/7 text-gray-300">
              <p class="flex-auto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor ut praesentium facere at sint nostrum, aliquid dolores ipsam beatae, illo quaerat perspiciatis deserunt ducimus explicabo sapiente, blanditiis iste omnis cumque.</p>
            </dd>
          </Container>
        </dl>
      </div>
    </div>
  </div>
</template>