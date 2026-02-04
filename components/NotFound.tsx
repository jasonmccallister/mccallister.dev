export function NotFound(props: { path: string }) {
  return (
    <html lang="en" data-theme="retro">
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>404 - Not Found | mccallister.dev</title>
        <meta name="description" content="Page not found" />
        <link rel="icon" href="/favicon.ico" />
        <link rel="stylesheet" href="/styles.css" />
        <script
          dangerouslySetInnerHTML={{
            __html: `
              (function() {
                const theme = localStorage.getItem('theme') ||
                  (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'retro');
                document.documentElement.setAttribute('data-theme', theme);
              })();
            `,
          }}
        />
      </head>
      <body class="h-screen bg-base-300 font-mono flex items-center justify-center p-4">
        <div class="w-full h-full max-w-4xl flex flex-col">
          {/* Terminal Window */}
          <div class="bg-base-200 rounded-t-lg border-b border-base-100 px-4 py-2 flex items-center gap-2">
            <div class="flex gap-1.5">
              <div class="w-3 h-3 rounded-full bg-error"></div>
              <div class="w-3 h-3 rounded-full bg-warning"></div>
              <div class="w-3 h-3 rounded-full bg-success"></div>
            </div>
            <span class="text-base-content/60 text-sm flex-1 text-center">
              bash -- 80x24
            </span>
          </div>

          {/* Terminal Content */}
          <div class="bg-base-100 flex-1 p-4 md:p-6 rounded-b-lg overflow-auto">
            <div class="space-y-4 text-sm md:text-base">
              {/* Command */}
              <div>
                <span class="text-success">jason@mccallister.dev</span>
                <span class="text-base-content">:</span>
                <span class="text-primary">~</span>
                <span class="text-base-content">$</span>
                <span class="text-base-content">
                  curl -v https://mccallister.dev{props.path}
                </span>
              </div>

              {/* curl output */}
              <div class="text-base-content/70 space-y-1">
                <p>* Trying 127.0.0.1:443...</p>
                <p>* Connected to mccallister.dev (127.0.0.1) port 443</p>
                <p>* TLS 1.3 connection established</p>
                <p>&gt; GET {props.path} HTTP/2</p>
                <p>&gt; Host: mccallister.dev</p>
                <p>&gt; User-Agent: curl/8.4.0</p>
                <p>&gt; Accept: */*</p>
                <p>&gt;</p>
              </div>

              {/* Response Headers */}
              <div class="text-base-content/70 space-y-1">
                <p class="text-error">&lt; HTTP/2 404</p>
                <p>&lt; content-type: text/html; charset=utf-8</p>
                <p>&lt; x-powered-by: coffee-and-questionable-decisions</p>
                <p>&lt; x-developer-mood: confused</p>
                <p>&lt;</p>
              </div>

              {/* Response Body */}
              <div class="mockup-code bg-base-300 text-xs md:text-sm">
                <pre data-prefix="1">
                  <code>{"{"}</code>
                </pre>
                <pre data-prefix="2">
                  <code> "status": 404,</code>
                </pre>
                <pre data-prefix="3">
                  <code> "error": "Not Found",</code>
                </pre>
                <pre data-prefix="4" class="text-warning">
                  <code>
                    {" "}
                    "message": "The page you're looking for has gone on
                    vacation.",
                  </code>
                </pre>
                <pre data-prefix="5" class="text-warning">
                  <code>
                    {" "}
                    "suggestion": "It didn't leave a forwarding address.",
                  </code>
                </pre>
                <pre data-prefix="6">
                  <code> "path": "{props.path}",</code>
                </pre>
                <pre data-prefix="7">
                  <code>
                    {" "}
                    "tried": ["asking nicely", "checking under the couch",
                    "blame DNS"],
                  </code>
                </pre>
                <pre data-prefix="8">
                  <code> "dns_fault": true,</code>
                </pre>
                <pre data-prefix="9">
                  <code> "developer_excuse": "works on my machine"</code>
                </pre>
                <pre data-prefix="10">
                  <code>{"}"}</code>
                </pre>
              </div>

              {/* Closing output */}
              <div class="text-base-content/70 space-y-1">
                <p>* Connection #0 to host mccallister.dev left intact</p>
                <p class="text-error">
                  curl: (22) The requested URL returned error: 404
                </p>
              </div>

              {/* Next prompt with cursor */}
              <div>
                <span class="text-success">jason@mccallister.dev</span>
                <span class="text-base-content">:</span>
                <span class="text-primary">~</span>
                <span class="text-base-content">$</span>
                <span class="inline-block w-2 h-4 bg-primary animate-pulse">
                </span>
              </div>
            </div>
          </div>

          {/* Action buttons */}
          <div class="mt-4 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="/" class="btn btn-primary">
              <span class="text-lg mr-1">&lt;-</span> cd /home
            </a>
            <a href="javascript:history.back()" class="btn btn-outline">
              <span class="text-lg mr-1">!</span> retry last command
            </a>
          </div>
        </div>
      </body>
    </html>
  );
}
