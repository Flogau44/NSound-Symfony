<template>
  <main class="max-h-full pt-0 md:pt-2">
    <section class="mt-6">
      <div class="mb-4 flex flex-row justify-center">
        <h1 class="uppercase">— Contact —</h1>
      </div>
      <div class="mb-4 text-2xl font-semibold flex flex-row justify-center">
        N’hésitez pas à nous contacter
      </div>
      <div class="w-full md:w-[600px] md:max-w-full mx-auto">
        <div class="p-6">
          <form
            class="flex flex-col gap-y-6 md:grid md:grid-cols-2 md:gap-6"
            method="POST"
            action=""
          >
            <label class="block">
              <span class="text-darkblue text-xl font-semibold"
                >Nom<span class="text-red">*</span></span
              >
              <input
                type="text"
                name="name"
                class="block w-full mt-1 px-2 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
                placeholder="Nom"
                required
              />
            </label>
            <label class="block">
              <span class="text-darkblue text-xl font-semibold"
                >Prénom<span class="text-red">*</span></span
              >
              <input
                type="text"
                name="firstname"
                class="block w-full mt-1 px-2 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
                placeholder="Prénom"
                required
              />
            </label>
            <label class="block">
              <span class="text-darkblue text-xl font-semibold"
                >Email<span class="text-red">*</span></span
              >
              <input
                type="email"
                name="email"
                class="block w-full mt-1 px-2 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
                required
              />
            </label>
            <label class="block">
              <span class="text-darkblue text-xl font-semibold"
                >Titre de votre message</span
              >
              <input
                type="text"
                name="firstname"
                class="block w-full mt-1 px-2 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
                required
              />
            </label>
            <label class="block mb-6 md:col-span-full">
              <span class="text-darkblue text-xl font-semibold"
                >Message<span class="text-red">*</span></span
              >
              <textarea
                name="message"
                class="block w-full mt-1 px-2 placeholder-navyblue-900 border-darkblue border-2 rounded-sm shadow-sm focus:border-blue focus:ring focus:ring-blue focus:ring-opacity-50"
                rows="6"
                placeholder="Votre message..."
              ></textarea>
            </label>
          </form>
          <div class="mb-6">
            <button
              type="submit"
              class="h-10 px-5 text-white text-xl font-bold bg-navyblue rounded-lg transition-colors duration-700 focus:shadow-outline hover:bg-blue-700"
            >
              Envoyer
            </button>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>
