---
title: "Common Issues Using Scratch Images"
slug: "common-issues-using-scratch-images"
date: "2025-01-26"
readingTime: "1 min read"
featured: false
featuredImage: "https://mccallister.dev/content/images/size/w960/2025/06/CleanShot-2025-06-05-at-10.35.04@2x.png"
description: "Pitfalls to watch out for when building container images from scratch."
tags: ["containers", "docker", "go"]
---

Using `FROM SCRATCH` in container builds can be tricky. I discovered this firsthand when shipping a Go application that needed to make API requests.

The first issue tripped me up when deploying an application requiring API connectivity. There are multiple overlooked pitfalls in this containerization technique.

Lots of good details in this tutorial: [Building Container Images FROM Scratch: 6 Pitfalls That Are Often Overlooked](https://labs.iximiuz.com/tutorials/pitfalls-of-from-scratch-images) from Ivan Velichko's labs.

Key issues to watch out for:

1. **Missing CA certificates** - Your app won't be able to make HTTPS requests
2. **No timezone data** - Time-related functionality may break
3. **Missing user/group files** - Can cause permission issues
4. **No shell for debugging** - Makes troubleshooting difficult
5. **Static linking requirements** - Dynamic libraries won't be available
6. **DNS resolution issues** - Network calls may fail unexpectedly

When building Go applications for scratch images, remember to:

```bash
CGO_ENABLED=0 go build -o app
```

This ensures your binary is statically linked and doesn't depend on system libraries.
