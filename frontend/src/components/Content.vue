<template>
  <v-template class="content">
    <div class="video-trail">
      <div class="welcome-item--presentation">
        <div class="welcome-item--presentation-text">
          <h1>Trilha de Conteúdos da Conecta Huggy</h1>
          <p>
            Conteúdos para acelerar o sucesso do seu negócio.
          </p>
        </div>
        <div class="welcome-item--presentation-img">
          <img src="@/assets/img/hyggor-2.svg" alt="Welcome">
        </div>
      </div>
      <div class="video-trail--grid">
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/KaKFJu6-J6c?si=k_Z7us_dBkCALyNG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/jU39MmxPfCU?si=CIVMDrqfSnW4ky-I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/itw6rDh6zv0?si=FZ13I0iwxNAa7WoA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
      </div>
      <div class="video-trail--grid">
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/KlKYWpw1m9E?si=Vxv56lKHP7vaFkSh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/GmShhgrk2UQ?si=kA7TSZmp_Pk_OZKq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
      </div>
      <div class="video-trail--banner">
        <img alt="conteudo" src="@/assets/img/banner.png">
      </div>
      <div class="video-trail--grid">
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/_bNOBHfgVOM?si=TWO8w9c0u6paIRJz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/GmShhgrk2UQ?si=kA7TSZmp_Pk_OZKq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
      </div>
      <div class="video-trail--grid">
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/AqCupIGevsw?si=T1wiCoCdV2kgX0lL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/jU39MmxPfCU?si=CIVMDrqfSnW4ky-I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="video-container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/ir_ybmTFeio?si=fTxeZv7tJh59_meh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
      </div>
  </div>
  </v-template>
</template>

<script setup lang="ts">
import VTemplate from "@/components/ui/VTemplate.vue";
</script>

<style scoped lang="scss">
.welcome-item--presentation-img img {
  max-width: 80%;
}

.video-trail {
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 2rem;
  gap: 4rem;

  &--banner {
    display: flex;
    justify-content: center;
    flex-direction: column;
    img {
      margin-top: 4rem;
      margin-bottom: 2rem;

      @media (max-width: 768px) {
        margin-top: 1rem;
        margin-bottom: 1rem;
      }
    }
  }

  &--grid {
    display: flex;
    justify-content: center;
    gap: 1rem;
    @media (max-width: 768px) {
      flex-wrap: wrap;
    }
  }
}

.video-container {
  margin-bottom: 1rem;
  background-color: #fff;
  border: 1px solid #d7d7d7;
  border-radius: 15px;
  box-shadow: 2px 9px 49px -17px rgba(0,0,0,0.3);
  min-height: 204px;

  @media (max-width: 768px) {
    flex-direction: column;
  }

  position: relative;
  width: 100%;

  iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    min-height: 250px;
    border-radius: 8px;

    @media (max-width: 768px) {
      min-height: auto;
    }
  }
}

h1 {
  color: var(--vt-c-text-dark-4);
  margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
  .video-trail--grid {
    flex-direction: column;
  }

  .video-container {
    padding-bottom: 60%;
  }
}
</style>