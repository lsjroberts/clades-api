# Clades

## What is a clade?

> A clade is a group consisting of an ancestor and all its descendants, a single "branch" on the "tree of life". The ancestor may be an individual, a population or even a species (extinct or extant). Many familiar groups, rodents and insects for example, are clades; others, like lizards and monkeys, are not (lizards excludes snakes, monkeys excludes apes and humans).

[http://en.wikipedia.org/wiki/Clade](http://en.wikipedia.org/wiki/Clade)

## What is the aim of this project?

To provide an interactive resource for studying the relationships between organisms, taxa and clades. It is not designed to provide a full resource of information regarding each entity, just primarily the relationships.

An example use case would be to find how distantly related humans are to another species.

A secondary objective is to provide an API for retrieving this data for developers to use for other projects / tools.

### What about existing projects?

There are several similar existing projects:

- [Catalogue of Life](http://www.catalogueoflife.org/)
- [Tree of Life Web Project](http://www.tolweb.org/)
- [Encyclopedia of Life](http://eol.org/)

This project does not intend to be a definitive or authoritative source of all known species, instead it is aimed towards providing useful and easily accessible information, particularly for laymen.

The existing sources are pretty information dense and geared more toward researchers.

### Difficulties

There are some difficulties presented by the fact that taxa are still being defined and modified. Additionally there are distinct differences between the hierarchy of taxa and clades.

New taxonomies tend to represent a clade, but this is not always the case and was not historically.

For example, mammals in taxonomy are defined as:

```
> Subphylum **Vertebrata**
  > Infraphylum **Gnathostomoata**
    > Superclass **Tetrapoda**
      > Class **Synapsida**
        > Class **Mammalia**
```

However the clades would be listed as:

```
> Subphylum **Vertebrata**
  > Infraphylum **Gnathostomoata**
    > Superclass **Tetrapoda**
      > Class **Synapsida**
        > Eupelycosauria
          > Sphenaconditia
            > Therapsida
              > Eutherapsida
                > Neotherapsida
                  > Theriodontia
                    > Eutheridontia
                      > Cynodontia
                        > Probainognathia
                          > Class **Mammalia**
```

So **Mammalia** are descendants of **Synapsida**. This particular difference between the taxonomy and clades may partially derive from the fact that **Mammalia** are the only extant **Synapsida**.

Additionally, sources differ on whether **Synapsida** is a class or clade (Vertebrate Palaeontology (Benton) vs. Tree of Life Web Project).

The eight major taxonomic ranks are:

- Domain (Eukaryota)
- Kingdom (Animalia)
- Phylum (Chordata)
- Class (Mammalia)
- Order (Primates)
- Family (Hominidae)
- Genus (Homo)
- Species (Homo Sapiens)

Furthermore there are a multitude of minor taxonomic classification which sit outside these major ranks. These includes sub-, super- and infra- variations of those eight, and also include but are not limited to:

- Tribe (between family and genus)
- Legion (non-obligatory, subordinate to class, groups related orders)
- Cohort (subordinate to legion, ordinate to order)

There are also some differences between zoology and botany, for example botany also defines sections, varieties, forms (morphs) and cultivars.

Basically, it's a bit of a clusterfuck.

It's hardly suprising though when you consider that evolution in reality isn't a distinct step-by-step, it's very much gradual and thus differentiating organism relationships is a bit tricky. Especially when working of an incomplete fossil record.

So, I'll do what I can but there may be errors / differences in data. I'll also build in a simple/complete toggle which switches between only the major 8 ranks and all known ranks.

Having said all that I'll be listing data with sources where possible, allowing multiple sources for the same datum. So for example, the family [Herrerasauridae](http://en.wikipedia.org/wiki/Herrerasauridae) can be described in two different cladograms depending on the source.

**Fernando E. Novas, Martin D. Ezcurra, Sankar Chatterjee and T. S. Kutty in 2011**

```
> Saurischia
  > Herrerasauridae
    > Herrasaurus
    > Staurikosaurus
    > ?
  > Eusaurischia
    > Theropoda
      > Chindesaurus
    > Sauropodmorpha
```

**Hans-Dieter Sues, Sterling J. Nesbitt, David S Berman and Amy C. Henrici, in 2011/12**

```
> Saurischia
  > Sauropodmorpha
  > Theropoda
    > Herrerasauridae
      > Staurikosaurus
      > .
        > Herrasaurus
        > Chindesaurus
```

As you can see, many of the taxa / clades move around. This will be represented by having the cladograms side by side with toggles to switch them on / off.


## Data

### Taxa

### Clades

### Organisms

## API

## Testing

### Acceptance Tests

Run acceptance tests with:

```
php artisan behat:run
php artisan behat:run --format=html > report_test.html
```

### Unit Tests

_not yet implemented_