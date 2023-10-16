<template>
  <div>
    <v-dialog
      v-model="dialogtambah"
      max-width="800px"
      persistent
      class="rounded-xl"
      transition="dialog-bottom-transition"
    >
      <v-card class="rounded-xl">
        <div class="text-h6 px-8 mb-6 py-6 white--text bg-tambah">
          Tambah data {{ item }}
        </div>
        <div class="pt-0 px-8 pb-8">
          <div v-if="$route.path.includes('/halaman-admin')">
            <v-text-field
              type="text"
              v-model="detaildatadialog.nama"
              label="Name"
              outline
            ></v-text-field>
          </div>
          <div v-if="$route.path.includes('/varianbarang/')">
            <v-text-field
              type="text"
              v-model="detaildatadialog.nama"
              label="Name"
              outline
            ></v-text-field>
            <v-text-field
              type="number"
              v-model="detaildatadialog.harga"
              label="harga"
              outline
            ></v-text-field>
            <v-text-field
              type="number"
              v-model="detaildatadialog.stok"
              label="stok"
              outline
            ></v-text-field>
             <div class="preview mb-4">
              <v-img :src="prev" v-if="prev" width="200px"></v-img>
            </div>
            <label
              for="fileInput"
              class="custom-file-upload-create rounded-lg py-2 px-4 white--text"
            >
              <span>Choose File</span>
            </label>
            <input
              class="inputfileku"
              id="fileInput"
              type="file"
              v-on:change="upload"
            />
          </div>

          <div v-if="$route.path.includes('/fotobarang/')">
            <div class="preview mb-4">
              <v-img :src="prev" v-if="prev" width="200px"></v-img>
            </div>
            <label
              for="fileInput"
              class="custom-file-upload-create rounded-lg py-2 px-4 white--text"
            >
              <span>Choose File</span>
            </label>
            <input
              class="inputfileku"
              id="fileInput"
              type="file"
              v-on:change="upload"
            />
          </div>

          <div class="d-flex justify-end mt-8">
            <v-btn class="rounded-lg px-8" outlined @click="closetambah"
              >Close</v-btn
            >
            <v-btn
              class="rounded-lg ml-8 px-8 white--text"
              color="#2f432d"
              @click="konfirmtambah"
              >Tambah</v-btn
            >
          </div>
        </div>
      </v-card>
    </v-dialog>
  </div>
</template>
  <script>
export default {
  props: [
    "dialogtambah",
    "detaildatadialog",
    "upload",
    "prev",
    "closetambah",
    "item",
    "konfirmtambah",
  ],
};
</script>
