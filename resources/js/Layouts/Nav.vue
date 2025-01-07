<script setup>
import { ref, computed } from 'vue';
import { Dialog, DialogPanel } from '@headlessui/vue';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { usePage } from '@inertiajs/vue3';

const mobileMenuOpen = ref(false);

const page = usePage();
const user = computed(() => page.props.auth.user);
</script> 

<template>
  <header>
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-4 lg:px-8" aria-label="Global">
      <div class="flex items-center gap-x-1">
        <Link :href="route('home')" class="-m-1.5 p-1.5">
          <img class="h-10 w-auto" src="../Images/Icon.png" alt="App Logo" />
        </Link>
        <Link :href="route('home')" class="hidden lg:flex lg:gap-x-12 text-xl font-semibold text-white">
          Deskify
        </Link>
      </div>
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400" @click="mobileMenuOpen = true">
          <i class="fa-solid fa-bars-staggered fa-lg" aria-hidden="true"></i>
        </button>
      </div>
      <div class="hidden lg:flex">
        <!-- Logged in User -->
        <div v-if="user">
          <Popover class="relative" >
            <PopoverButton class="inline-flex items-center gap-x-1 text-sm/6 font-semibold text-white">
              <span class="text-base px-1">
                {{ user.name }}
              </span>
              <i class="fa-solid fa-chevron-down fa-lg text-gray-400" aria-hidden="true"></i>
            </PopoverButton>
            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
              <PopoverPanel class="absolute left-1/2 z-10 mt-5 flex w-screen max-w-min -translate-x-1/2 px-4">
                <div class="w-56 shrink rounded-2xl bg-white/5 backdrop-blur-xl p-4 text-sm/6 font-semibold text-slate-400 ring-1 ring-white/10 divide-y divide-gray-500/25">
                  <div class="pb-2">
                    <Link :href="route('home')" class="block p-2 hover:text-indigo-600">
                      Home
                    </Link>
                    <Link :href="route('calendar')" v-if="user.role === 'user'" class="block p-2 hover:text-indigo-600">
                      Dashboard
                    </Link>
                    <Link :href="route('admin.users')" v-if="user.role === 'admin'" class="block p-2 hover:text-indigo-600">
                      Dashboard
                    </Link>                     
                  </div>
                  <div class="py-2">
                    <Link :href="route('logout')" method="post" as="button" class="block px-2 pt-2 hover:text-indigo-600">
                      Log out
                    </Link>
                  </div>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>
        </div>
        <!-- User before Logging in  -->
        <div v-else>
          <Link :href="route('login')" class="rounded-xl bg-indigo-600 px-3.5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-800">Log In</Link>
        </div>
      </div>
    </nav>

    <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
      <div class="fixed inset-0 z-10">
      <DialogPanel class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white/5 backdrop-blur-xl p-4 sm:max-w-sm sm:ring-1 sm:ring-white/10">
        <div class="flex items-center justify-between">
            <img class="h-10 w-auto" src="../Images/Icon.png" alt="App Logo" />
          <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-400" @click="mobileMenuOpen = false">
            <i class="fa-solid fa-xmark fa-lg" aria-hidden="true"></i>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <!-- Logged in User -->
          <div v-if="user">
            <div class="-my-6 divide-y divide-gray-500/25">
              <div class="space-y-2 py-6">
                <Link :href="route('home')" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5">Home</Link>
                <Link :href="route('calendar')" v-if="user.role === 'user'" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5">Dashboard</Link>
                
                <Link :href="route('admin.users')" v-if="user.role === 'admin'" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5">Dashboard</Link>
              </div>
              <div class="py-6">
                <Link :href="route('logout')" method="post" as="button" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-white/5 ">Log out</Link>
              </div>
            </div>
          </div>
          <!-- User before Logging in  -->
          <div v-else>
            <div class="-my-6 divide-y divide-gray-500/25">
              <div class="space-y-2 py-6">
                <Link :href="route('home')" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5">Home</Link>
              </div>
              <div class="py-6">
                <Link :href="route('login')" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-white/5 ">Log in</Link>
              </div>
            </div>
          </div>
        </div>
      </DialogPanel>
      </div>
    </Dialog>
  </header>

  <main>
      <slot />
  </main>
</template>