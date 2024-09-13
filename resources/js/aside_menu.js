
const status = statusSidebar();

const toggler = document.querySelector(".toggler-btn");

toggler.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("collapsed");
});

function statusSidebar() {
  const sidebarStatus = localStorage.getItem("sidebarStatus");

  if (sidebarStatus == null) {
    localStorage.setItem("sidebarStatus", false);
    return false;
  }

  const isExpanded = sidebarStatus === "true";

  if (isExpanded) {
    document.querySelector("#sidebar").classList.add("expand");
  } else {
    document.querySelector("#sidebar").classList.remove("expand");
  }


  return isExpanded;
}