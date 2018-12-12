<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

<xsl:template match="previsions">
    <xsl:apply-templates select="echeance"/>
</xsl:template>

<xsl:template match="echeance">
    <xsl:apply-templates select="temperature"/>
</xsl:template>

<xsl:template match="temperature">
    <xsl:apply-templates select="level"/>
</xsl:template>

<xsl:template match="level">
    <xsl:if test="@val='sol'">
        <xsl:variable name="temp" select="."/>
        Temperature : <xsl:value-of select="$temp - 273.15"/> degrés celcius.
    </xsl:if>   
</xsl:template>

</xsl:stylesheet>