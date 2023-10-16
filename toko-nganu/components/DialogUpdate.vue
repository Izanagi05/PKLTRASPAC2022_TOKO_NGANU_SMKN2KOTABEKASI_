  <template>
  <div>
    <v-dialog
      v-model="dialogedit"
      max-width="800px"
      persistent
      class="rounded-xl"
      transition="dialog-bottom-transition"
    >
      <v-card class="rounded-xl">
        <div class="text-h6 px-8 mb-6 py-6 white--text bg-update">
          Ubah data {{ item }}
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
          <div v-if="$route.path === '/user-view/toko-user'">
            <v-text-field
              type="text"
              v-model="detaildatadialog.nama"
              label="Name"
              outline
            ></v-text-field>
            <v-text-field
              type="text"
              v-model="detaildatadialog.alamat"
              label="alamat"
              outline
            ></v-text-field>
            <v-text-field
              type="number"
              v-model="detaildatadialog.no_telepon"
              label="no telepon"
              outline
            ></v-text-field>
            <v-text-field
              type="text"
              v-model="detaildatadialog.deskripsi"
              label="deskripsi"
              outline
            ></v-text-field>
            <label
              for="fileInput"
              class="custom-file-upload rounded-lg py-2 px-4 white--text"
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
          <div
            v-if="
              $route.path.includes('/user-view/toko-user/detailtoko/') &&
              !$route.path.includes('/varianbarang/') &&
              !$route.path.includes('/fotobarang/')
            "
          >
            <v-text-field
              type="text"
              v-model="detaildatadialog.nama"
              label="Name"
              outline
            ></v-text-field>
            <select v-model="detaildatadialog.kategori_id" label="Pilih">
              <option disabled>Pilih Kategori</option>
              <option
                v-for="(toko, index) in kategori"
                :value="toko.kategori_id"
                :key="index"
              >
                {{ toko.nama }}
              </option>
            </select>
            <v-text-field
              type="text"
              v-model="detaildatadialog.deskripsi"
              label="deskripsi"
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
            <label
              for="fileInput"
              class="custom-file-upload rounded-lg py-2 px-4 white--text"
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
            <label
              for="fileInput"
              class="custom-file-upload rounded-lg py-2 px-4 white--text"
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
            <v-btn class="rounded-lg px-8" outlined @click="closeedit"
              >Close</v-btn
            >
            <v-btn
              class="rounded-lg ml-8 px-8 white--text"
              color="#4caf50"
              @click="updateedit"
              >Ubah</v-btn
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
    "dialogedit",
    "detaildatadialog",
    "kategori",
    "upload",
    "closeedit",
    "item",
    "updateedit",
  ],
};
</script>
