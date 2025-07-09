<style>
    .scrollable-tabs-container {
        overflow: hidden;
        position: relative;
    }

    .scrollable-tabs-container svg {
        width: 25px;
        height: 25px;
        padding: 8px;
        cursor: pointer;
        color: #000;
        border-radius: 50%;
        pointer-events: auto;
        transition: .3s all;
    }

    .scrollable-tabs-container ul {
        display: flex;
        /* gap: 16px; */
        /* padding: 12px 24px; */
        margin: 0;
        list-style: none;
        overflow-x: scroll;
        -ms-overflow-style: none;
        scrollbar-width: none;
        scroll-behavior: smooth;
    }

    .scrollable-tabs-container ul.dragging a {
        pointer-events: none;
    }

    .scrollable-tabs-container ul.dragging {
        scroll-behavior: auto;
    }

    .scrollable-tabs-container ul::-webkit-scrollbar {
        display: none;
    }

    .scrollable-tabs-container a {
        color: #000;
        text-decoration: none;
        background: transparent;
        padding: .3rem .5rem;
        display: inline-block;
        border-radius: 4px;
        user-select: none;
        white-space: nowrap;
        transition: .3s all;
        font-size: .8rem;
        font-family: "Poppins", sans-serif;
    }

    /* .scrollable-tabs-container a.active {
  background: #fff;
  color: #000;
} */
    .scrollable-tabs-container a:hover {
        background: #99999927;
        color: #000;
    }

    .scrollable-tabs-container .right-arrow,
    .scrollable-tabs-container .left-arrow {
        position: absolute;
        height: 100%;
        width: 100px;
        top: 0;
        display: none;
        align-items: center;
        padding: 0 10px;
        pointer-events: none;
        z-index: 2;
    }

    .scrollable-tabs-container .right-arrow.active,
    .scrollable-tabs-container .left-arrow.active {
        display: flex;
    }

    .scrollable-tabs-container .right-arrow {
        right: 0;
        background: linear-gradient(to left, #f1f3f8 50%, transparent);
        justify-content: flex-end;
    }

    .scrollable-tabs-container .left-arrow {
        background: linear-gradient(to right, #f1f3f8 50%, transparent);
    }

    .scrollable-tabs-container svg:hover {
        background: #36b6fd;
        color: #fff;
    }
</style>
