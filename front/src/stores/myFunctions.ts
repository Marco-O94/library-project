
// 😭😭 I hate Typescript and I hate this file too 😭😭

/* My dear Debounce */
export const debounce: any = (fn: { apply: (arg0: any, arg1: any[]) => void; }, wait: number | undefined) => {
    let timer: number | undefined;
   return  (...args: any) => {
     if(timer) {
        clearTimeout(timer); // clear any pre-existing timer
     }
     // eslint-disable-next-line @typescript-eslint/no-this-alias
     const context = this; // get the current context
     timer = setTimeout(()=>{
        fn.apply(context, args); // call the function if time expires
     }, wait);
   }
}

// How to use it => const debouncedFunction = debounce(function() { console.log('HELLO') }, 1000);

/* My dear Throttle */
export const throttle = (fn: { apply: (arg0: any, arg1: any[]) => void; }, wait: number | undefined) => {
    let throttled = false;
    return (...args: any) => {
        if(!throttled){
            fn.apply(this,args);
            throttled = true;
            setTimeout(()=>{
                throttled = false;
            }, wait);
        }
    }
}