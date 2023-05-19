    function EuclideanSimilarity(vector1, vector2) {
        let res = 0.0;
        let sum = 0;
        for (let i = 0; i < vector1.length; i++) {
            const diff = vector1[i] - parseFloat(vector2[i]);
            sum += diff ** 2;
        }
    
        res = Math.sqrt(sum);
        return res;
    }
    
    function unqList(daList, nominalIndexes) {
        const map = new Map();
        const res = [];
        for (let i of nominalIndexes) {
            for (let l of daList) {
                map.set(l[i], i);
            }
        }
    
        map.forEach((value, key) => {
            res.push(key);
        });
    
        return res;
    }
    
    function OneShotEncoding(list, uniqueList) {
        const res = [];
        for (let l of uniqueList) {
            if (list.includes(l)) {
                res.push(1.0);
            } else {
                res.push(0.0);
            }
        }
    
        return res;
    }
    
    function minMax(list, numaricIndexes) {
        const res = [];
    
        for (const i of numaricIndexes) {
            let min = Number.MAX_VALUE;
            let max = Number.MIN_VALUE;
    
            // find the min and the max
            for (const row of cars) {
                const num = parseFloat(row[i]);
                if (num < min) {
                    min = num;
                }
                if (num > max) {
                    max = num;
                }
            }
    
            // Calculation
            for (let j = 0; j < list.length; j++) {
                if (i === j) {
                    res.push((parseFloat(list[i]) - min) / (max - min));
                }
            }
        }
    
        return res;
    }

