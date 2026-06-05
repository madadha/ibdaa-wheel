const canvas = document.getElementById("wheelCanvas");
const spinButton = document.getElementById("spinButton");
const modal = document.getElementById("resultModal");
const closeModal = document.getElementById("closeModal");
const spinAgainButton = document.getElementById("spinAgainButton");

const modalCategory = document.getElementById("modalCategory");
const modalTitle = document.getElementById("modalTitle");
const modalDescription = document.getElementById("modalDescription");
const modalQuestion = document.getElementById("modalQuestion");

const categories = window.wheelCategories || [];
const items = window.wheelItems || [];
const texts = window.wheelTexts || {};
const currentLang = window.currentLang || "ar";

let ctx = null;
let currentRotation = 0;
let isSpinning = false;

const categoryIcons = ["🛡️", "⭐", "🚀", "🤝"];

if (canvas && items.length > 0) {
    ctx = canvas.getContext("2d");
    document.fonts.ready.then(() => {
        drawWheel();
    });
}

function getFont(size, weight = "bold") {
    const fontName = currentLang === "he" ? "Rubik" : "Cairo";
    return `${weight} ${size}px ${fontName}, Arial, sans-serif`;
}

function drawWheel(rotation = 0) {
    const size = canvas.width;
    const center = size / 2;

    const outerRadius = center - 18;
    const innerRadius = outerRadius * 0.58;
    const centerRadius = outerRadius * 0.18;

    ctx.clearRect(0, 0, size, size);

    ctx.save();
    ctx.translate(center, center);
    ctx.rotate(rotation);

    drawOuterItems(outerRadius, innerRadius);
    drawInnerCategories(innerRadius, centerRadius);
    drawCenterCircle(centerRadius);

    ctx.restore();
}

function drawOuterItems(outerRadius, innerRadius) {
    const segmentAngle = (2 * Math.PI) / items.length;

    items.forEach((item, index) => {
        const startAngle = index * segmentAngle;
        const endAngle = startAngle + segmentAngle;

        ctx.beginPath();
        ctx.arc(0, 0, outerRadius, startAngle, endAngle);
        ctx.arc(0, 0, innerRadius, endAngle, startAngle, true);
        ctx.closePath();

        ctx.fillStyle = item.color || "#3498db";
        ctx.fill();

        ctx.strokeStyle = "rgba(255,255,255,0.78)";
        ctx.lineWidth = 3;
        ctx.stroke();

        drawOuterText(item.title, startAngle, endAngle, outerRadius, innerRadius);
    });

    ctx.beginPath();
    ctx.arc(0, 0, outerRadius, 0, Math.PI * 2);
    ctx.lineWidth = 15;
    ctx.strokeStyle = "#74451f";
    ctx.stroke();

    ctx.beginPath();
    ctx.arc(0, 0, innerRadius, 0, Math.PI * 2);
    ctx.lineWidth = 5;
    ctx.strokeStyle = "rgba(255,255,255,0.88)";
    ctx.stroke();
}

function drawInnerCategories(innerRadius, centerRadius) {
    if (categories.length === 0) {
        return;
    }

    const segmentAngle = (2 * Math.PI) / categories.length;

    categories.forEach((category, index) => {
        const startAngle = index * segmentAngle;
        const endAngle = startAngle + segmentAngle;

        ctx.beginPath();
        ctx.arc(0, 0, innerRadius, startAngle, endAngle);
        ctx.arc(0, 0, centerRadius, endAngle, startAngle, true);
        ctx.closePath();

        ctx.fillStyle = category.color || "#888888";
        ctx.fill();

        ctx.strokeStyle = "rgba(255,255,255,0.9)";
        ctx.lineWidth = 6;
        ctx.stroke();

        drawInnerCategoryContent(
            category.title,
            categoryIcons[index] || "✨",
            startAngle,
            endAngle,
            innerRadius,
            centerRadius
        );
    });
}

function drawCenterCircle(centerRadius) {
    ctx.beginPath();
    ctx.arc(0, 0, centerRadius, 0, Math.PI * 2);
    ctx.fillStyle = "#d7a55c";
    ctx.fill();

    ctx.lineWidth = 9;
    ctx.strokeStyle = "#74451f";
    ctx.stroke();

    ctx.beginPath();
    ctx.arc(0, 0, centerRadius * 0.55, 0, Math.PI * 2);
    ctx.fillStyle = "#fffaf1";
    ctx.fill();

    ctx.fillStyle = "#d89a35";
    ctx.font = getFont(42, "bold");
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    ctx.fillText("♥", 0, 3);
}

function drawOuterText(text, startAngle, endAngle, outerRadius, innerRadius) {
    const angle = startAngle + (endAngle - startAngle) / 2;
    const textRadius = (outerRadius + innerRadius) / 2;

    ctx.save();
    ctx.rotate(angle);
    ctx.translate(textRadius, 0);
    ctx.rotate(Math.PI / 2);

    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    ctx.fillStyle = "#ffffff";
    ctx.font = getFont(18, "bold");

    const shortText = shortenText(text, 20);
    wrapText(ctx, shortText, 0, 0, 112, 24);

    ctx.restore();
}

function drawInnerCategoryContent(text, icon, startAngle, endAngle, innerRadius, centerRadius) {
    const angle = startAngle + (endAngle - startAngle) / 2;
    const textRadius = (innerRadius + centerRadius) / 2;

    ctx.save();
    ctx.rotate(angle);
    ctx.translate(textRadius, 0);

    ctx.textAlign = "center";
    ctx.textBaseline = "middle";

    // Icon circle
    ctx.beginPath();
    ctx.arc(0, -34, 25, 0, Math.PI * 2);
    ctx.fillStyle = "rgba(255,255,255,0.22)";
    ctx.fill();

    ctx.beginPath();
    ctx.arc(0, -34, 25, 0, Math.PI * 2);
    ctx.lineWidth = 2;
    ctx.strokeStyle = "rgba(255,255,255,0.55)";
    ctx.stroke();

    // Icon
    ctx.font = "26px Arial, sans-serif";
    ctx.fillStyle = "#ffffff";
    ctx.fillText(icon, 0, -33);

    // Title
    ctx.fillStyle = "#ffffff";
    ctx.font = getFont(21, "bold");
    wrapText(ctx, text, 0, 22, 145, 28);

    ctx.restore();
}

function shortenText(text, maxLength) {
    if (!text) return "";
    if (text.length <= maxLength) return text;
    return text.substring(0, maxLength) + "...";
}

function wrapText(context, text, x, y, maxWidth, lineHeight) {
    const words = String(text).split(" ");
    let line = "";
    const lines = [];

    words.forEach(word => {
        const testLine = line + word + " ";
        const metrics = context.measureText(testLine);

        if (metrics.width > maxWidth && line !== "") {
            lines.push(line.trim());
            line = word + " ";
        } else {
            line = testLine;
        }
    });

    lines.push(line.trim());

    const startY = y - ((lines.length - 1) * lineHeight) / 2;

    lines.forEach((lineText, index) => {
        context.fillText(lineText, x, startY + index * lineHeight);
    });
}

function spinWheel() {
    if (isSpinning || items.length === 0) {
        return;
    }

    isSpinning = true;
    spinButton.disabled = true;

    const selectedIndex = Math.floor(Math.random() * items.length);
    const segmentAngle = (2 * Math.PI) / items.length;

    const pointerAngle = -Math.PI / 2;
    const selectedMiddleAngle = selectedIndex * segmentAngle + segmentAngle / 2;

    const extraSpins = 6 * Math.PI * 2;
    const targetRotation = extraSpins + pointerAngle - selectedMiddleAngle;

    const startRotation = currentRotation;
    const finalRotation = currentRotation + targetRotation;
    const duration = 4300;
    const startTime = performance.now();

    function animate(now) {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const eased = easeOutCubic(progress);

        const rotation = startRotation + (finalRotation - startRotation) * eased;
        drawWheel(rotation);

        if (progress < 1) {
            requestAnimationFrame(animate);
        } else {
            currentRotation = finalRotation % (Math.PI * 2);
            isSpinning = false;
            spinButton.disabled = false;

            setTimeout(() => {
                showResult(items[selectedIndex]);
            }, 250);
        }
    }

    requestAnimationFrame(animate);
}

function easeOutCubic(x) {
    return 1 - Math.pow(1 - x, 3);
}

function showResult(item) {
    modalCategory.textContent = `${texts.category}: ${item.category}`;
    modalTitle.textContent = item.title;
    modalDescription.textContent = item.description || "";
    modalQuestion.textContent = item.question || "";

    modal.classList.add("is-open");
}

function hideModal() {
    modal.classList.remove("is-open");
}

if (spinButton) {
    spinButton.addEventListener("click", spinWheel);
}

if (spinAgainButton) {
    spinAgainButton.addEventListener("click", () => {
        hideModal();
        setTimeout(spinWheel, 250);
    });
}

if (closeModal) {
    closeModal.addEventListener("click", hideModal);
}

if (modal) {
    modal.addEventListener("click", (event) => {
        if (event.target === modal) {
            hideModal();
        }
    });
}