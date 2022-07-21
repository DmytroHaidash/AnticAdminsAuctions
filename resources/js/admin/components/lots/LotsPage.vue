<template>
    <div v-if="lots">
        <div class="row mb-4">
            <div class="col pr-0">
                <input class="form-control" v-model="search" placeholder="search">
            </div>

            <div class="col-auto">
                <button class="btn btn-primary" @click.prevent="getAllLots(url)">Find</button>
            </div>

        </div>
        <div class="mb-4">
            <button class="btn btn-outline-primary" @click.prevent="getExportOne()">Export One</button>
        </div>
        <table class="table">
            <thead class="small">
            <tr>
                <th width="20"></th>
                <th @click.prevent="sorting('id')" class="ids">
                    <div class="d-inline-flex">
                        Id
                        <div v-if="sort === 'id'" class="ml-2">
                            <svg width="16" height="16">
                                <use :href="icon"></use>
                            </svg>
                        </div>
                    </div>
                </th>
                <th @click.prevent="sorting('title')">
                    <div class="d-inline-flex">
                        Title
                        <div v-if="sort === 'title'" class="ml-2">
                            <svg width="16" height="16">
                                <use :href="icon"></use>
                            </svg>
                        </div>
                    </div>
                </th>
                <th @click.prevent="sorting('author')">
                    <div class="d-inline-flex">
                        Author
                        <div v-if="sort === 'author'" class="ml-2">
                            <svg width="16" height="16">
                                <use :href="icon"></use>
                            </svg>
                        </div>
                    </div>
                </th>
                <th>Category</th>
                <th @click.prevent="sorting('num')">
                    <div class="d-inline-flex">
                        Num
                        <div v-if="sort === 'num'" class="ml-2">
                            <svg width="16" height="16">
                                <use :href="icon"></use>
                            </svg>
                        </div>
                    </div>
                </th>
                <th @click.prevent="sorting('low_estimate')">
                    <div class="d-inline-flex">
                        Low estimate
                        <div v-if="sort === 'low_estimate'" class="ml-2">
                            <svg width="16" height="16">
                                <use :href="icon"></use>
                            </svg>
                        </div>
                    </div>
                </th>
                <th @click.prevent="sorting('high_estimate')">
                    <div class="d-inline-flex">
                        High estimate
                        <div v-if="sort === 'high_estimate'" class="ml-2">
                            <svg width="16" height="16">
                                <use :href="icon"></use>
                            </svg>
                        </div>
                    </div>
                </th>
                <th @click.prevent="sorting('starting_price')">
                    <div class="d-inline-flex">
                        Starting price
                        <div v-if="sort === 'starting_price'" class="ml-2">
                            <svg width="16" height="16">
                                <use :href="icon"></use>
                            </svg>
                        </div>
                    </div>
                </th>
                <th @click.prevent="sorting('created_at')">
                    <div class="d-inline-flex">
                        Created
                        <div v-if="sort === 'created_at'" class="ml-2">
                            <svg width="16" height="16">
                                <use :href="icon"></use>
                            </svg>
                        </div>
                    </div>
                </th>
                <th></th>
            </tr>
            </thead>
            <tr v-for="(lot, index) in lots">
                <td width="20">
                    <input :id="'select_'+index" type="checkbox" :checked="selectedItems.includes(lot.id)" @change="addSelect(lot.id)">
                </td>
                <td class="ids">{{ lot.id }}</td>
                <td>{{ lot.title }}</td>
                <td>{{ lot.author }}</td>
                <td>{{ lot.category }}</td>
                <td>{{ lot.num }}</td>
                <td>{{ lot.low_estimate }}</td>
                <td>{{ lot.high_estimate }}</td>
                <td>{{ lot.starting_price }}</td>
                <td class="nobr">{{ lot.created }}</td>
                <td width="80" class="nobr">
                    <a :href="lot.edit"
                       class="btn btn-warning btn-squire rounded-circle">
                        <i class="i-pencil"></i>
                    </a>
                    <button class="btn btn-danger btn-squire rounded-circle"
                            onclick="delete(lot.delete)">
                        <i class="i-trash"></i>
                    </button>
                </td>
            </tr>
        </table>
        <div class="d-flex h-10 justify-content-center align-items-center">
            <button class="btn btn-primary mr-4" @click="previousPage()" :disabled="!previous">Previous page</button>
            <p class="mr-4 mt-3">{{currentPage}} / {{lastPage}}</p>
            <button class="btn btn-primary" @click="nextPage()" :disabled="!next">Next page</button>
        </div>
    </div>
</template>

<script>
  export default {
    name: "LotsPage",
    data() {
      return {
        url: '/api/lots',
        sort: 'created_at',
        order: 'asc',
        search: '',
        lots: [],
        next: '',
        previous: '',
        icon: '#asc',
        currentPage: 1,
        lastPage: 1,
        selectedItems: [],
      }
    },
    created() {
      this.getAllLots();
    },
    methods: {
      getLots(url) {
        axios
          .post(url, {sort: this.sort, order: this.order, search: this.search})
          .then(({data}) => {
            this.lots = data.items;
            this.next = data.next;
            this.previous = data.previous;
            this.lastPage = data.last;
            this.currentPage = data.current;
          });
      },
      getAllLots() {
        this.getLots(this.url);
      },
      sorting(sort) {
        if (this.sort === sort) {
          this.order = this.order === 'desc' ? 'asc' : 'desc';
        } else {
          this.sort = sort;
          this.order = 'asc';
        }
        this.getSortSvg();
        this.getLots(this.url)
      },
      delete(link) {
        confirm('Sure?').then(result => {
          console.log(result)
        });

      },
      getSortSvg() {
        this.icon = '#' + this.order;
      },
      nextPage() {
        console.log('click');
        this.getLots(this.next);
      },
      previousPage() {
        this.getLots(this.previous);
      },
      addSelect(id) {
        let index = this.selectedItems.indexOf(id);
        if (index !== -1) {
          this.selectedItems.splice(index, 1);
        } else {
          this.selectedItems.push(id);
        }
      },
      isSelected(id) {
        this.selectedItems.includes(id);
        console.log()
      },
      async getExport(exportLink) {
        await axios
          .post(exportLink, {ids: this.selectedItems, sort: this.sort, order: this.order, search: this.search}, {responseType: 'blob'})
          .then(response => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            let fileLink = document.createElement('a');
            fileLink.href = url;
            fileLink.setAttribute('download', 'export.xlsx');

            document.body.appendChild(fileLink);

            fileLink.click();
          }).catch(error => {
            console.log(error);
          });
      },
      getExportOne() {
        this.getExport('/export/first');
      }

    }
  }
</script>

<style scoped>
    .ids {
        width: 80px;
    }
</style>