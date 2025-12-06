import "./bootstrap";

// Smooth scroll for footer links using Bootstrap tabs
document.addEventListener("DOMContentLoaded", function () {
    const footerLinks = document.querySelectorAll(".forevestor-footer-link");
    footerLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const href = this.getAttribute("href");
            const tabName = href.substring(1);
            const tabTrigger = document.querySelector(
                `[data-bs-target="#${tabName}"]`
            );
            if (tabTrigger) {
                const tab = new bootstrap.Tab(tabTrigger);
                tab.show();
                document
                    .querySelector(".forevestor-tabs-sticky")
                    .scrollIntoView({
                        behavior: "smooth",
                    });
            }
        });
    });
    // Add scroll listener for sticky navigation
    window.addEventListener("scroll", function () {
        const tabsSticky = document.querySelector(".forevestor-tabs-sticky");
        if (window.scrollY > 100) {
            tabsSticky.style.boxShadow = "0 8px 20px rgba(0, 0, 0, 0.1)";
        } else {
            tabsSticky.style.boxShadow = "0 4px 12px rgba(0, 0, 0, 0.06)";
        }
    });
    // Print functionality
    window.printLegal = function () {
        const activeTab = document.querySelector(".tab-pane.show.active");
        if (activeTab) {
            const printWindow = window.open("", "_blank");
            const content = document.querySelector(
                ".forevestor-content-wrapper"
            ).innerHTML;
            printWindow.document.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Forevestor Legal Documents</title>
                            <style>
                                body { font-family: Inter, sans-serif; line-height: 1.6; color: #333; padding: 20px; }
                                h1, h2 { color: #dda125; }
                                .forevestor-section-header { margin-bottom: 30px; }
                                .forevestor-alert-premium { background: #f5f2f7; padding: 20px; border-left: 4px solid #dda125; margin: 20px 0; }
                            </style>
                        </head>
                        <body>
                            <h1>Forevestor - Legal Documents</h1>
                            <p>Generated on: ${new Date().toLocaleDateString()}</p>
                            ${content}
                        </body>
                        </html>
                    `);
            printWindow.document.close();
            printWindow.print();
        }
    };
    // Download functionality
    window.downloadLegal = function () {
        const content = document.querySelector(
            ".forevestor-content-wrapper"
        ).innerHTML;
        const element = document.createElement("a");
        element.setAttribute(
            "href",
            "data:text/html;charset=utf-8," + encodeURIComponent(content)
        );
        element.setAttribute("download", "forevestor-legal-documents.html");
        element.style.display = "none";
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    };
});
