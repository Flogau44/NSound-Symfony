<template>
  <nav class="mt-6">
    <ul
      class="flex flex-col items-center justify-center gap-4 font-bold text-base md:text-2xl md:flex-row md:items-end"
    >
      <li>
        <!-- Lien vers la page Venir -->
        <NavLink
          :to="{ name: 'Infos_pratiques' }"
          title="Vers la page Venir du site 'Nation Sound'"
        >
          Venir
        </NavLink>
      </li>
      <li>
        <!-- Lien vers la page Sur place -->
        <NavLink
          :to="{ name: 'Sur_place' }"
          title="Vers la page Sur place du site 'Nation Sound'"
        >
          Sur place
        </NavLink>
      </li>
      <li>
        <!-- Lien vers la page Où dormir -->
        <NavLink
          :to="{ name: 'Ou_dormir' }"
          title="Vers la page Où dormir du site 'Nation Sound'"
        >
          Où dormir?
        </NavLink>
      </li>
      <li>
        <!-- Lien vers la page Accessibilité -->
        <NavLink
          :to="{ name: 'Accessibilite' }"
          title="Vers la page Accessibilité du site 'Nation Sound'"
        >
          Accessibilité
        </NavLink>
      </li>
      <li>
        <!-- Lien vers la page FAQ -->
        <NavLink
          :to="{ name: 'Faq1' }"
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
  name: "NavSub",
  components: {
    NavLink,
  },
};
</script>
