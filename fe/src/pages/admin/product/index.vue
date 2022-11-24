<template>
  <a-button type="primary" style="float: right; margin-bottom: 10px"
    ><router-link :to="{ name: 'admin-product-create' }"
      >Thêm</router-link
    ></a-button
  >
  <a-table :data-source="products" :columns="columns">
    <template #headerCell="{ column }">
      <template v-if="column.key === 'name'">
        <span style="color: #1890ff">Name</span>
      </template>
    </template>
    <template
      #customFilterDropdown="{
        setSelectedKeys,
        selectedKeys,
        confirm,
        clearFilters,
        column,
      }"
    >
      <div style="padding: 8px">
        <a-input
          ref="searchInput"
          :placeholder="`Search ${column.dataIndex}`"
          :value="selectedKeys[0]"
          style="width: 188px; margin-bottom: 8px; display: block"
          @change="
            (e) => setSelectedKeys(e.target.value ? [e.target.value] : [])
          "
          @pressEnter="handleSearch(selectedKeys, confirm, column.dataIndex)"
        />
        <a-button
          type="primary"
          size="small"
          style="width: 90px; margin-right: 8px"
          @click="handleSearch(selectedKeys, confirm, column.dataIndex)"
        >
          <template #icon><SearchOutlined /></template>
          Search
        </a-button>
        <a-button
          size="small"
          style="width: 90px"
          @click="handleReset(clearFilters)"
        >
          Reset
        </a-button>
      </div>
    </template>
    <template #bodyCell="{ column, index, record }">
      <template v-if="column.key === 'stt'">
        <span>{{ index + 1 }}</span>
      </template>
      <template v-if="column.key === 'name'">
        <span class="open_modal-showProduct" @click="showModal(record.id)">
          {{ record.name.toUpperCase() }}
        </span>
      </template>
      <template v-if="column.key === 'thumbnail'">
        <a-image :width="100" :src="record.thumbnail" :alt="record.name" />
      </template>
      <template v-if="column.key === 'price'">
        <span>{{
          record.discount - 0
            ? " giá gốc : " +
              (record.price - 0) / 1 +
              "đ" +
              "  | " +
              "giá sau khi giảm : " +
              ((record.price - 0) * (100 - (record.discount - 0))) / 100 +
              "đ"
            : (record.price - 0).toFixed(0) + "đ"
        }}</span>
      </template>
      <template v-if="column.key === 'discount'">
        <span>{{ (record.discount - 0).toFixed(0) }}%</span>
      </template>
      <template v-if="column.key === 'status'">
        <span class="btn" :class="record.status ? 'isActive' : 'notActive'">{{
          record.status === 1 ? "Hoạt động" : "Tạm dừng hoạt động"
        }}</span>
      </template>
      <template v-if="column.key === 'action'">
        <div class="action-icon">
          <router-link
            :to="{
              name: 'admin-product-update',
              params: { id: record.id },
            }"
            style="display: block; margin-right: 5px"
            class="action-icon"
            ><EditOutlined> ></EditOutlined></router-link
          >
        </div>
        <div class="action-icon">
          <DeleteProduct @deleteSuccess="reloadHome" :id="record.id">
          </DeleteProduct>
        </div>
      </template>
    </template>
  </a-table>
  <!--  modal show info product-->
  <div class="col-12">
    <a-modal
      v-model:visible="visible"
      title="Thông tin sản phẩm "
      @ok="handleOk"
    >
      <p class="proudct-info">
        <strong>Tên sản phẩm :</strong> {{ product.name.toUpperCase() }}
      </p>
      <p class="product-info">
        <strong>Giá sản phẩm : </strong>
        {{
          product.discount - 0
            ? " Giá gốc : " +
              (product.price - 0) / 1 +
              "đ" +
              "  | " +
              "Giá sau khi giảm : " +
              ((product.price - 0) * (100 - (product.discount - 0))) / 100 +
              "đ"
            : (product.price - 0).toFixed(0) + "đ"
        }}
      </p>
      <div class="product-info">
        <strong style="margin-right: 10px">Ảnh mô tả : </strong>
        <a-image
          :width="100"
          :height="100"
          :src="product.thumbnail"
          :alt="product.name"
        />
      </div>
      <p class="product-info"><strong>Mô tả : </strong> {{ product.desc }}</p>
    </a-modal>
  </div>
</template>

<script>
import { useStoreMenu } from "@/store/store-nav-menu";
import useProduct from "@/composables/admin/useProduct";
import { onMounted, ref, reactive, toRefs } from "vue";
import { SearchOutlined } from "@ant-design/icons-vue";
import DeleteProduct from "@/pages/admin/product/deleteProduct";
import { EditOutlined } from "@ant-design/icons-vue";
export default {
  name: "index-user",
  components: {
    DeleteProduct,
    EditOutlined,
    SearchOutlined,
  },
  setup() {
    const storeMenu = useStoreMenu();
    //  fix menu bar
    storeMenu.onSelectedKeys(["admin-product"]);
    // get columns data tabel
    //search
    const keyword = ref("");
    const state = reactive({
      searchText: "",
    });
    const columns = [
      {
        title: "Tên sản phẩm",
        dataIndex: "name",
        key: "name",
        align: "left",
        sorter: (a, b) => a.name.length - b.name.length,
        sortDirections: ["descend", "ascend"],
        customFilterDropdown: true,
        onFilter: (value, record) =>
          record.name.toString().toLowerCase().includes(value.toLowerCase()),
      },
      {
        title: "Danh mục",
        dataIndex: "cate_name",
        key: "category_name",
        align: "center",
      },
      {
        title: "Ảnh mô tả sp",
        dataIndex: "thumbnail",
        key: "thumbnail",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Giảm giá (%)",
        dataIndex: "discount",
        key: "discount",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Giá sản phẩm",
        dataIndex: "price",
        key: "price",
        align: "center",
      },
      {
        title: "Trạng thái sản phẩm",
        dataIndex: "status",
        key: "status",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Action",
        key: "action",
        align: "center",
      },
    ];
    //search column
    const handleSearch = (selectedKeys, confirm) => {
      confirm();
      state.searchText = selectedKeys[0];
    };
    const handleReset = (clearFilters) => {
      clearFilters({
        confirm: true,
      });
      state.searchText = "";
    };
    //get product
    const { getProducts, getProduct, product, products } = useProduct();
    onMounted(getProducts);
    //active modal show product
    const visible = ref(false);
    const showModal = async (id) => {
      await getProduct(id);
      visible.value = true;
    };
    const handleOk = (e) => {
      console.log(e);
      visible.value = false;
    };
    const reloadHome = () => {
      getProducts();
    };
    return {
      products,
      columns,
      showModal,
      handleOk,
      visible,
      product,
      reloadHome,
      keyword,
      handleSearch,
      handleReset,
      ...toRefs(state),
    };
  },
};
</script>

<style scoped>
.isActive {
  background-color: #42d392;
}
.notActive {
  background-color: #dc143c;
}
.action-icon {
  font-size: 20px;
  margin-right: 15px;
  outline: none;
  color: #000;
}
.action-icon:hover {
  color: red;
  cursor: pointer;
}
.open_modal-showProduct {
  cursor: pointer;
}
.open_modal-showProduct:hover {
  color: red;
}
.product-info {
  margin-bottom: 10px;
}
</style>
