<template>
    <div class="bottom-buttons">
        <TextIconButton :content="this.$translator.translate('app.next')" height="2rem" width="7rem" icon="chevron_right" flex-direction="row-reverse" @click="nextPage()"/>
        <div class="pages">
            <div v-for="pageNumber in getPageList()" :class="{'current_page': pageNumber === this.currentPage, 'box': pageNumber !== this.pageDelimiter}" @click="specificPage(pageNumber)">
                {{pageNumber !== this.pageDelimiter ? pageNumber : '...' }}
            </div>
        </div>
        <TextIconButton :content="this.$translator.translate('app.previous')" height="2rem" width="7rem" icon="chevron_left" @click="previousPage()"/>
    </div>
</template>


<script>

import TextIconButton from "@/components/Button/TextIconButton.vue";

export default {
    name: "PageBar",
    components: {
        TextIconButton
    },
    props: {
        currentPage: {
            type: Number,
            required: true
        },
        lastPage: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            pageDelimiter: -1
        }
    },
    methods: {
        getPageList() {
            const pageList = [];
            const currentPage = this.currentPage;
            const totalPages = this.lastPage;

            // Add the first page
            pageList.push(1);

            // Add the previous 2 pages
            for (let i = currentPage - 2; i < currentPage; i++) {
                if (i > 1) pageList.push(i);
            }

            // Add the current page
            if (!pageList.includes(currentPage)) pageList.push(currentPage);

            // Add the next 2 pages
            for (let i = currentPage + 1; i <= currentPage + 2 && i <= totalPages; i++) {
                pageList.push(i);
            }

            // Add the last page
            if (!pageList.includes(totalPages)) pageList.push(totalPages);

            return this.addDelimiter(pageList);
        },
        addDelimiter(array) {
            const result = [];

            for (let i = 0; i < array.length; i++) {
                result.push(array[i]);

                if (i < array.length - 1 && array[i + 1] - array[i] > 1) {
                    result.push(this.pageDelimiter);
                }
            }

            return result;
        },
        nextPage() {
            if (this.currentPage + 1 <= this.lastPage) {
                this.$emit('changePage', this.currentPage + 1);
            }
        },
        previousPage() {
            if (this.currentPage - 1 >= 1) {
                this.$emit('changePage', this.currentPage - 1);
            }
        },
        specificPage(pageNumber) {
            if (pageNumber !== this.pageDelimiter) {
                this.$emit('changePage', pageNumber);
            }
        }
    }
}

</script>


<style scoped lang="scss">

.pages {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  gap: 0.35rem;
}

.current_page {
  color: var(--color-white);
  background-color: var(--color-secondary-soft);
}

</style>