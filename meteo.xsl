<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

<xsl:template match="previsions">
    <xsl:apply-templates select="echeance"/>
</xsl:template>

<xsl:template match="echeance">
    <div>
    <xsl:if test="@hour &lt; 27">
        <xsl:value-of select="@hour - 3"/>-<xsl:value-of select="@hour"/>h :
        <xsl:apply-templates select="temperature"/><xsl:text>, </xsl:text>
        <xsl:apply-templates select="pluie"/>
    </xsl:if>
    </div>
</xsl:template>

<xsl:template match="temperature">
    <xsl:apply-templates select="level"/>
</xsl:template>

<xsl:template match="level">
    <xsl:if test="@val='sol'">
        <xsl:variable name="temp" select="."/>
        <xsl:value-of select="round($temp - 273.15)"/>°C
    </xsl:if>   
</xsl:template>

<xsl:template match="pluie">
    <xsl:choose>
  	    <xsl:when test=". = 0">
  		    pas de risque de pluie.
        </xsl:when>
        <xsl:when test="(. &gt; 0) and (. &lt; 1)">
            un peu de pluie.
        </xsl:when>
        <xsl:when test="(. = 1) or (. &gt; 1) and (. &lt; 2)">
            pluie moyenne.
        </xsl:when>
        <xsl:when test="(. = 2) or (. &gt; 2) and (. &lt; 3)">
            beaucoup de pluie.
        </xsl:when>
        <xsl:when test="(. = 3) or (. &gt; 3)">
            trop de pluie.
        </xsl:when>
  	    <xsl:otherwise>
  		    pas de données de pluie.
  	    </xsl:otherwise>
    </xsl:choose>
</xsl:template>

</xsl:stylesheet>