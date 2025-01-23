<script setup>
import Container from '../Components/Container.vue';
</script>

<template>
  <div class="py-12 sm:py-14">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:text-center">
        <h2 class="text-base/7 font-semibold text-indigo-400">
          The way you like
        </h2>
        <h1 class="text-balance text-5xl font-semibold tracking-tight text-white sm:text-7xl">Book your desk in a seamless way!</h1>
        <p class="mt-8 text-pretty text-lg font-medium text-gray-400 sm:text-xl/8">Say goodbye to the chaos of unorganized office spaces. Choose your favorite comfortable desk and make your work efficient and stress-free with a few simple clicks.</p>
      </div>
      <div class="mx-auto mt-14 max-w-2xl sm:mt-16 lg:mt-24 lg:max-w-none">
        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-3">
          <Container class="flex flex-col sm:min-w-full">
            <dt class="flex items-center gap-x-3 text-base/7 sm:text-lg/7 font-semibold text-white">
              <i class="fa-solid fa-calendar-days fa-lg flex-none text-indigo-400" aria-hidden="true"></i>
              Booking Calendar
            </dt>
            <dd class="mt-4 flex flex-auto flex-col text-base/7 sm:text-md/7 text-gray-300">
              <p class="flex-auto">Navigate an easy-to-use calendar to find and reserve desks that suit your needs. With real-time updates on availability, you can quickly identify free workspaces and secure your spot with just a few clicks.</p>
            </dd>
          </Container>
          <Container class="flex flex-col sm:min-w-full">
            <dt class="flex items-center gap-x-3 text-base/7 sm:text-lg/7 font-semibold text-white">
              <i class="fa-solid fa-money-check fa-lg flex-none text-indigo-400" aria-hidden="true"></i>
              Detailed Desks 
            </dt>
            <dd class="mt-4 flex flex-auto flex-col text-base/7 sm:text-md/7 text-gray-300">
              <p class="flex-auto">Each desk comes with detailed information, including photos and names, to help you choose the best option. Whatever your preference, you'll always find the perfect desk to match your needs.</p>
            </dd>
          </Container>
          <Container class="flex flex-col sm:min-w-full">
            <dt class="flex items-center gap-x-3 text-base/7 sm:text-lg/7 font-semibold text-white">
              <i class="fa-solid fa-gears fa-lg flex-none text-indigo-400" aria-hidden="true"></i>
              Better Experience
            </dt>
            <dd class="mt-4 flex flex-auto flex-col text-base/7 sm:text-md/7 text-gray-300">
              <p class="flex-auto">Deskify is constantly evolving to meet your needs. In the near future, new features will be introduced to significantly enhance workspace management and improve overall experience of using the application.</p>
            </dd>
          </Container>
        </dl>
      </div>
    </div>
  </div>
</template>