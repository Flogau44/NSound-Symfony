<template>
  <div>
    <div
      id="artistsOrPlanning"
      class="ml-4 pb-4 flex flex-row justify-start gap-x-4"
    >
      <!-- Bouton pour afficher les artistes -->
      <button
        id="filterButtonsArtist"
        type="button"
        class="active h-10 px-5 rounded-md outline-none transition-colors duration-700 text-xl font-bold"
      >
        Artistes
      </button>
      <!-- Bouton pour afficher les horaires -->
      <button
        id="filterButtonsPlanning"
        type="button"
        class="h-10 px-5 rounded-md outline-none transition-colors duration-700 text-xl font-bold"
      >
        Horaires
      </button>
    </div>
    <div
      id="filterButtonsSubLevel"
      class="mx-4 pb-4 grid grid-cols-2 justify-start gap-4 md:grid-cols-[repeat(4,auto)]"
    >
      <!-- Bouton pour afficher la line-up des artistes -->
      <button
        type="button"
        class="active h-10 px-5 rounded-md outline-none transition-colors duration-700 text-xl font-bold"
        data-filter="lineupArtist"
      >
        Line-Up
      </button>
      <!-- Boutons pour filtrer par date -->
      <button
        v-for="date in dates"
        :key="date.filter"
        type="button"
        class="h-10 px-5 rounded-md outline-none transition-colors duration-700 text-xl font-bold"
        :data-filter="date.filter"
      >
        {{ date.label }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "FilterArtists",
  data() {
    return {
      dates: [
        { filter: "2025-07-11", label: "Ven.11/07", class: "active" },
        { filter: "2025-07-12", label: "Sam.12/07", class: "" },
        { filter: "2025-07-13", label: "Dim.13/07", class: "" },
      ],
    };
  },
  mounted() {
    // Sélectionner les éléments HTML
    const artistsOrPlanning = document.querySelectorAll(
      "#artistsOrPlanning button"
    );
    const filterButtonsArtist = document.getElementById("filterButtonsArtist");
    const filterButtonsPlanning = document.getElementById(
      "filterButtonsPlanning"
    );
    const filterButtonsSubLevelAll = document.getElementById(
      "filterButtonsSubLevel"
    );
    const postsContainerArtists = document.getElementById("artists");
    const postsContainerPlanning = document.getElementById("planning");

    // Fonction permettant de filtrer les artistes en fonction des boutons de filtrage (artistes ou planning)
    const filterArtistsOrPlanning = (e) => {
      document
        .querySelector("#artistsOrPlanning .active")
        .classList.remove("active");
      e.target.classList.add("active");
    };
    artistsOrPlanning.forEach((button) =>
      button.addEventListener("click", filterArtistsOrPlanning)
    );

    // Lors du clique sur le bouton "Artistes", les boutons du dessous s'affichent et les artistes apparaissent
    filterButtonsArtist.addEventListener("click", () => {
      filterButtonsSubLevelAll.style.display = "grid";
      postsContainerArtists.style.display = "grid";
      postsContainerPlanning.style.display = "none";
    });

    // Lors du clique sur le bouton "Horaires", les boutons du dessous disparaissent et le planning apparait
    filterButtonsPlanning.addEventListener("click", () => {
      filterButtonsSubLevelAll.style.display = "none";
      postsContainerArtists.style.display = "none";
      postsContainerPlanning.style.display = "grid";
    });

    // Afficher les artistes en fonction des dates
    const filterButtonsSubLevel = document.querySelectorAll(
      "#filterButtonsSubLevel button"
    );
    const filterArtist = document.getElementById("artists").children;

    // Fonction permettant de filtrer les artistes en fonction des boutons de filtrage (boutons date)
    const filterArtists = (e) => {
      document
        .querySelector("#filterButtonsSubLevel .active")
        .classList.remove("active");
      e.target.classList.add("active");
      for (let i = 0; i < filterArtist.length; i++) {
        if (
          filterArtist[i].dataset.name === e.target.dataset.filter ||
          e.target.dataset.filter === "lineupArtist"
        ) {
          filterArtist[i].classList.replace("hide", "show");
        } else {
          filterArtist[i].classList.add("hide");
        }
      }
    };
    filterButtonsSubLevel.forEach((button) =>
      button.addEventListener("click", filterArtists)
    );
  },
};
</script>
