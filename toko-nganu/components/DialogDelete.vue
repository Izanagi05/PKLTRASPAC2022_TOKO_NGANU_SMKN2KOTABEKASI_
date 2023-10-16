<template>
  <div>
    <v-dialog v-model="dialogDelete" max-width="800px" color="ffffff">
        <v-card class="pt-15 px-8 pb-8 rounded-xl">
          <div class="text-h6 pl-4">
            Apakah kamu yakin ingin menghapus item ini?
          </div>
          <div class="grey--text text-body-2 pl-4 mt-4">
            Item yang sudah dihapus tidak bisa dikembalikan lagi
          </div>
          <div class="d-flex justify-end mt-15">
            <v-btn class="rounded-lg px-8" outlined @click="closeDelete"
              >Batal</v-btn
            >
            <v-btn
              class="rounded-lg px-8 ml-8 white--text"
              color="#FF3548"
              @click="confirmhapus"
              >Hapus</v-btn
            >
          </div>
        </v-card>
      </v-dialog>
  </div>
</template>

<script>
export default {
  props:[
    'dialogDelete',
    'closeDelete',
    'confirmhapus',
]

}
</script>
