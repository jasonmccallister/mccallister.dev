---
title: "Common issues using scratch images"
slug: "common-issues-using-scratch-images"
date: "2025-01-26"
readingTime: "1 min read"
featured: false
featuredImage: "/images/CleanShot-2025-06-05-at-10.35.04@2x.png"
description: "Pitfalls when you build container images FROM scratch."
tags: ["containers", "docker", "go"]
---

`FROM scratch` is smaller, but it bites. I learned that shipping a Go app that had to call HTTPS APIs.

Ivan Velichko covers the usual traps well in [Building container images FROM scratch: 6 pitfalls that are often overlooked](https://labs.iximiuz.com/tutorials/pitfalls-of-from-scratch-images).

Watch for these:

1. **Missing CA certificates** - HTTPS calls fail
2. **No timezone data** - anything time-based can break
3. **Missing user/group files** - permission errors
4. **No shell** - debugging gets harder
5. **Dynamic linking** - system libraries aren't there
6. **DNS** - name lookups can fail

For Go, build a static binary:

```bash
CGO_ENABLED=0 go build -o app
```

That keeps the binary from depending on libc in the image.
