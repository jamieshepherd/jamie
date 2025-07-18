+++
aliases = ['/logs/unity-dots-nativearray-defaults']
date = '2020-06-16'
location = 'SAN FRANCISCO, CALIFORNIA'
title = 'Unity DOTS NativeArray defaults'
+++

I wanted to create a set of chunks in a grid along the X \+ Z axis in Unity (with the power of DOTS). To track which chunks I have already instantiated, I created a `NativeArray<float3>` named `chunkPositions`. I set the size of this array to my world size (width by height) and I have a job that loops through all of the positions on the screen, checking which exist in `chunkPositions`. If the position does not exist, I can create a new chunk there.

This one stuck me for a little while. The chunk at 0,0,0 would just not instantiate. After digging a little deeper, it seems that no matter what - 0,0,0 would always exist in the `chunkPositions` NativeArray.

You're probably reading this and thinking - what a dummy. If you're not though, the reason for this behavior - is when you pre-allocate memory to the `NativeArray<T>`, it is automatically filled with zeroed out types (in my case, float3).

My solution to this is to instead start my terrain at `1f` in the Y plane, so chunks would instead be at: `0f, 1f, 0f`, `1f, 1f, 0f` and so on. Simple! This also means that a value of `0f, 0f, 0f` in the NativeArray can also be considered "not instantiated".
