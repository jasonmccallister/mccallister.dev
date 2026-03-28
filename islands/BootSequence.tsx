import { useSignal } from "@preact/signals";
import { useEffect } from "preact/hooks";

const BOOT_LINES = [
  { text: "[BIOS] mccallister.dev v2.0", delay: 0 },
  { text: "[OK]   Loading kernel modules...", delay: 200 },
  { text: "[OK]   Initializing network stack", delay: 400 },
  { text: "[OK]   Mounting /blog", delay: 600 },
  { text: "[OK]   Loading content from ./content/posts", delay: 850 },
  { text: "[OK]   Starting nginx on port 443", delay: 1050 },
  { text: "[OK]   TLS 1.3 handshake complete", delay: 1250 },
  { text: "", delay: 1400 },
  { text: "System ready. Welcome back.", delay: 1500 },
];

const TOTAL_DURATION = 2200;

export default function BootSequence() {
  const visible = useSignal(false);
  const fadingOut = useSignal(false);
  const visibleLines = useSignal(0);

  useEffect(() => {
    // Skip if already booted this session
    if (sessionStorage.getItem("booted")) return;

    // Skip if user prefers reduced motion
    if (globalThis.matchMedia("(prefers-reduced-motion: reduce)").matches) {
      sessionStorage.setItem("booted", "1");
      return;
    }

    // Show boot sequence
    visible.value = true;
    document.body.style.overflow = "hidden";
    sessionStorage.setItem("booted", "1");

    // Reveal lines one by one
    const timers: number[] = [];
    for (let i = 0; i < BOOT_LINES.length; i++) {
      timers.push(
        setTimeout(() => {
          visibleLines.value = i + 1;
        }, BOOT_LINES[i].delay),
      );
    }

    // Fade out and reveal site
    timers.push(
      setTimeout(() => {
        fadingOut.value = true;
      }, TOTAL_DURATION - 400),
    );

    timers.push(
      setTimeout(() => {
        visible.value = false;
        document.body.style.overflow = "";
      }, TOTAL_DURATION),
    );

    return () => {
      timers.forEach(clearTimeout);
      document.body.style.overflow = "";
    };
  }, []);

  if (!visible.value) return null;

  return (
    <div
      class={`fixed inset-0 z-[100] bg-base-300 flex items-center justify-center p-6 font-mono transition-opacity duration-400 ${
        fadingOut.value ? "opacity-0" : "opacity-100"
      }`}
      aria-hidden="true"
    >
      <div class="w-full max-w-2xl">
        <div class="space-y-1 text-sm md:text-base">
          {BOOT_LINES.slice(0, visibleLines.value).map((line, i) => (
            <p
              key={i}
              class={line.text === ""
                ? "h-4"
                : line.text.startsWith("[BIOS]")
                ? "text-primary font-bold"
                : line.text.startsWith("[OK]")
                ? "text-success"
                : "text-warning font-bold"}
            >
              {line.text}
            </p>
          ))}
          {visibleLines.value < BOOT_LINES.length && (
            <span class="inline-block w-2 h-4 bg-primary animate-pulse" />
          )}
        </div>
      </div>
    </div>
  );
}
