<template>
  <nav class="mt-6">
    <ul
      class="flex flex-col items-center justify-center gap-4 font-bold text-base md:text-2xl md:flex-row md:items-end"
    >
      <li>
        <NavLink
          :to="{ name: 'Infos_pratiques' }"
          title="Vers la page Venir du site 'Nation Sound'"
        >
          Venir
        </NavLink>
      </li>
      <li>
        <NavLink
          :to="{ name: 'Sur_place' }"
          title="Vers la page Sur place du site 'Nation Sound'"
        >
          Sur place
        </NavLink>
      </li>
      <li>
        <NavLink
          :to="{ name: 'Ou_dormir' }"
          title="Vers la page Où dormir du site 'Nation Sound'"
        >
          Où dormir?
        </NavLink>
      </li>
      <li>
        <NavLink
          :to="{ name: 'Accessibilite' }"
          title="Vers la page Accessibilité du site 'Nation Sound'"
        >
          Accessibilité
        </NavLink>
      </li>
      <li>
        <NavLink
          :to="{ name: 'Faq_1' }"
          title="Vers la page FAQ du site 'Nation Sound'"
        >
          f.a.q.
        </NavLink>
      </li>
    </ul>
  </nav>
</template>

<script>
import NavLink from "../components/NavLink.vue";

export default {
  name: "Nav_sub",
  components: {
    NavLink,
  },
};
</script>
