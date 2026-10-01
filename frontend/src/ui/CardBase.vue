<template>
<div class="card card-base">
  <div class="card-base--img">
    <slot name="content-img" />
  </div>
  <div class="card-base--items">
    <slot name="content-items"></slot>
    <div class="card-base--item-text">
      <slot name="content-text"></slot>
    </div>
    <div class="card-base--item-author">
      <slot name="content-author"></slot>
      <div class="card-base--item-author-details">
        <slot name="content-author-details"></slot>
      </div>
    </div>
  </div>
</div>
</template>

<style lang="scss">
.card {
  &-base {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 1rem;
    background-color: #fff;
    border: 1px solid #d7d7d7;
    border-radius: 15px;
    box-shadow: 2px 9px 49px -17px rgba(0,0,0,0.3);
    min-height: 204px;
    overflow: hidden;

    @media (max-width: 768px) {
      flex-direction: column;
    }

    &--img {
      flex: 1 1 40%;
      min-width: 300px;
      position: relative;

      @media (max-width: 991px) {
        flex: 1 1 100%;
        min-width: auto;
      }

      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px;

        @media (max-width: 768px) {
          border-radius: 15px 15px 0 0;
        }
      }
    }

    &--items {
      flex: 1 1 50%;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-evenly;

      @media (max-width: 991px) {
        flex: 1 1 100%;
      }
    }
    &--item {
      &-text {
        margin-bottom: 20px;
        @media (max-width: 991px) {
          text-align: center;
        }
        p {
          overflow: hidden;
          text-overflow: ellipsis;
          display: -webkit-box;
          -webkit-line-clamp: 3;
          -webkit-box-orient: vertical;

          @media (max-width: 991px) {
            margin: 0 auto;
            width: 100%;
          }
        }
      }
      &-author {
        display: inline-flex;
        align-items: center;
        word-wrap: break-word;

        @media (max-width: 991px) {
          justify-content: center;
        }

        &-details {
          margin-left: 5px;
        }

        img {
          height: 44px;
          width: 44px;
          border-radius: 100%;
          margin-right: 9px;
          object-fit: cover;
        }
      }
    }
    p {
      color: var(--vt-c-text-dark-3);
    }

    h1,h2,h3 {
      margin: 0 0 .4em;
      color: var(--vt-c-text-dark-4);
    }
  }
}
</style>
<script setup lang="ts">
</script>