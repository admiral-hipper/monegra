<template>
    <div id="not-found-page-wrapper">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>

        <div @click="$router.back()">
            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'NotFound'
    }
</script>

<style lang="scss" scoped>
    #not-found-page-wrapper {
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
        padding: 5rem;

        & > i {
            font-size: 150px;
            color: #ffc14e;
        }

        & > div {
            padding: .5rem 4rem;
            cursor: pointer;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 2px 2px 4px 1px rgba(0, 0, 0, .2);
            -moz-box-shadow: 2px 2px 4px 1px rgba(0, 0, 0, .2);
            box-shadow: 2px 2px 4px 1px rgba(0, 0, 0, .2);
            -webkit-transition: box-shadow 150ms;
            -moz-transition: box-shadow 150ms;
            -ms-transition: box-shadow 150ms;
            -o-transition: box-shadow 150ms;
            transition: box-shadow 150ms;

            &:hover:not(:active) {
                -webkit-box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, .2);
                -moz-box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, .2);
                box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, .2);
            }

            &:active {
                -webkit-box-shadow: 1px 1px 4px 0 rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 1px 1px 4px 0 rgba(0, 0, 0, 0.2);
                box-shadow: 1px 1px 4px 0 rgba(0, 0, 0, 0.2);
            }

            i {
                font-size: 25px;
                color: var(--light-grey-color);
            }
        }
    }
</style>
