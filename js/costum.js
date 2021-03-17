console.log("oke");
document.addEventListener("DOMContentLoaded", function () {
  const table = document.getElementsByClassName("table-responsive")[0];
  table.style.cursor = "auto";

  let pos = { top: 0, left: 0, x: 0, y: 0 };

  const mouseDownHandler = function (e) {
    table.style.cursor = "auto";

    pos = {
      left: table.scrollLeft,
      top: table.scrollTop,
      // Get the current mouse position
      x: e.clientX,
      y: e.clientY,
    };

    document.addEventListener("mousemove", mouseMoveHandler);
    document.addEventListener("mouseup", mouseUpHandler);
  };

  const mouseMoveHandler = function (e) {
    // How far the mouse has been moved
    const dx = e.clientX - pos.x;
    // const xa = document.getElementsByClassName("dt-responsive")[0];
    // xa.scrollLeft = pos.left - dx;
    table.scrollLeft = pos.left - dx;
  };

  const mouseUpHandler = function () {
    table.style.cursor = "auto";

    document.removeEventListener("mousemove", mouseMoveHandler);
    document.removeEventListener("mouseup", mouseUpHandler);
  };

  // Attach the handler
  table.addEventListener("mousedown", mouseDownHandler);
});

function hpsData() {
  confirm("Hapus Data ?");
}
