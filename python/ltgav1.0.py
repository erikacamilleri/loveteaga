#!/usr/bin/env python2
#encoding: UTF-8

# To change this license header, choose License Headers in Project Properties.
# To change this template file, choose Tools | Templates
# and open the template in the editor.
import random
from deap import creator, base, tools, algorithms

creator.create("FitnessMax", base.Fitness, weights=(1.0,))
creator.create("Individual", list, fitness=creator.FitnessMax)

toolbox = base.Toolbox()

toolbox.register("attr_bool", random.randint, 0, 1)
toolbox.register("individual", tools.initRepeat, creator.Individual, toolbox.attr_bool, n=24)
toolbox.register("population", tools.initRepeat, list, toolbox.individual)

def evalOneMax(individual):
    return sum(individual),

def evalTea(individual):
    #print 'working on individual'
    a = 0
    s = 0
    c = 0
    e = 0
    r = 0
    for i in range(0, len(individual), 2):
        x = str(individual[i]) + str(individual[i+1])
        if (x == '00'):
            e = e+1
        
        if (x == '01'):
            #print 'found an active'
            a = a + 1
        
        if (x == '10'):
            #print 'found a supporting'
            s = s + 1
        
        if (x == '11'):
            #print 'found a catalyst'
            c = c + 1
            
    if (a == 1 and s == 2 and c == 1):
        r = 10
    else:
        r = 0
    #if (a >= 1 and s >= 1 and c >= 1):
       # r = r + 1
    
   # r = r + 
   
    #print 'fitness: ' + str(r)
    return r,

toolbox.register("evaluate", evalTea)
toolbox.register("mate", tools.cxTwoPoint)
toolbox.register("mutate", tools.mutFlipBit, indpb=0.05)
toolbox.register("select", tools.selTournament, tournsize=3)

population = toolbox.population(n=300)

NGEN=500
for gen in range(NGEN):
    offspring = algorithms.varAnd(population, toolbox, cxpb=0.5, mutpb=0.1)
    fits = toolbox.map(toolbox.evaluate, offspring)
    for fit, ind in zip(fits, offspring):
        ind.fitness.values = fit
    population = toolbox.select(offspring, k=len(population))
top2 = tools.selBest(population, k=3)
print top2[0]